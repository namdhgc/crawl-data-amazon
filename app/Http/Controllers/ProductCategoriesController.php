<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\ProductCategories as ModelProductCategories;
use App\Http\Models\Media as ModelMedia;
use App\Http\Models\ProductCategoryDetail as ModelProductCategoryDetail;
use Spr\Base\Controllers\Helper as HelperController;
use Spr\Base\Controllers\CrawlData\simple_html_dom as SimpleHtmlDom;
use Spr\Base\Controllers\Http\Request as Rep;
use Intervention\Image\Exception\NotReadableException;
use Spr\Base\Response\Response;
use Input;
use Config;
use Auth;
use Lang;
use Session;
use DB;
use Image;

class ProductCategoriesController  extends Controller
{


    public function __construct()
    {

    }

    public function actionInsert_ProductCategories($data_output_validate_param) {

        $ModelProductCategories =  new ModelProductCategories();
        $url    = "https://www.amazon.co.jp";
        $html   = Rep::get_data_curl($url);
        $dom    = new SimpleHtmlDom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);

        $html   = $dom->load($html, true, true); 
        $html   = $html->find('script[type="text/javascript"]');
        $search = "HomeKitchenPetsPanel";
        $need_text = "";

        foreach ($html as $k_script => $val_script) {
            $text = $val_script->innertext;
            if(strpos($text, $search) !==false){
                $need_text = $text;
            }
        }
        
        $need_text = str_replace('window.$Nav && $Nav.when("data").run(function(data) { data(', '', $need_text);
        $need_text = str_replace('); });', '', $need_text);
        $categories = json_decode($need_text,true);

        // Remove element HomeKitchenPetsPanel of Categories.
        // dd($categories);

        unset($categories['templates']);

        // get Categories parent
        $shopAllContent = $categories['shopAllContent'];
        $cate_data = [];


        foreach ($shopAllContent['template']['data']['items'] as $key => $value) {

            if(isset($value['panelKey']) && !in_array($value['panelKey'], Config::get('spr.system.unset_product_categories'))){

                $parent_name = "";
                $tmp = [];
                $tmp['amazon_id'] = "";
                $tmp['name'] = $parent_name = $value['text'];
                $tmp['key'] = $value['panelKey'];
                $tmp['parent_id'] = 0;
                $tmp['parent_name'] = "";
                $tmp['level'] = 0;

                array_push($cate_data, $tmp);

                $subCategories = $categories[$value['panelKey']]['template']['data']['items'];

                foreach ($subCategories as $subCategories_key => $subCategories_value) {

                    $sub_parent_name = "";
                    $tmp1 = [];
                    $tmp1['amazon_id'] = "";
                    $tmp1['name'] = $sub_parent_name = $subCategories_value['text'];
                    $tmp1['key'] = "";
                    $tmp1['parent_id'] = 0;
                    $tmp1['parent_name'] = $parent_name;
                    $tmp1['level'] = 1;


                    if(array_key_exists("items", $subCategories_value)) {

                        array_push($cate_data, $tmp1);
                        $sub_child = $subCategories_value['items'];

                        foreach ($sub_child as $sub_child_key => $sub_child_value) {

                            $tmp2 = [];
                            $tmp2['amazon_id'] = $ModelProductCategories->get_product_id($sub_child_value['url']);
                            $tmp2['name'] = $sub_child_value['text'];
                            $tmp2['key'] = "";
                            $tmp2['parent_id'] = 0;
                            $tmp2['parent_name'] = $sub_parent_name;
                            $tmp2['level'] = 2;

                            array_push($cate_data, $tmp2);
                        }
                    }else {

                        $tmp1['amazon_id'] = $ModelProductCategories->get_product_id($subCategories_value['url']);
                        array_push($cate_data, $tmp1);
                    }

                }
            }
        }
        
        if(count($cate_data) > 0){
            $results = $ModelProductCategories->deleteAllData();
            if($results['meta']['success']){

                $ModelProductCategories->insertData($cate_data);
                $ModelProductCategories->updateCategoriesId();
                Cache::forget('product_categories');
                $data_output_validate_param['meta']['msg'] = "Update data sucess !";
            }   
            
        }
        return $data_output_validate_param;
    } 

    public function actionUpdateImage_Lang($data_output_validate_param){
       
        $results            = Response::response();

        if($data_output_validate_param['meta']['success']){

            $id                 =   $data_output_validate_param['response']['id'];
            $level              =   $data_output_validate_param['response']['level'];
            $title              =   $data_output_validate_param['response']['title']; 
            $background_image   =   $data_output_validate_param['response']['background_image_update'];  
            $icon               =   $data_output_validate_param['response']['icon_update'];

            $ModelProductCategoryDetail =  new ModelProductCategoryDetail();
            $ModelProductCategories     =  new ModelProductCategories();
            $ModelMedia                 =  new ModelMedia();

            $data_update = [
                'title'   =>  $title
            ];
            $where =    [
                [
                    'fields' => 'id',
                    'operator' => '=',
                    'value' => $id,
                ]
            ];


            if($level == 0){

                $mime_type = Config::get('spr.type.mimeFile');
                $path_tmp = public_path( Config::get('spr.system.uploadMedia.path_tmp_upload') );
                $path     = public_path( Config::get('spr.system.uploadMedia.path_image_upload') );
                HelperController::create_path($path_tmp);

                if($icon != '') {

                    $icon_name                  =  'i_'.HelperController::uniqid_base36($data_output_validate_param['response']['created_at']);
                    $icon_original_mime         =  $icon->getMimeType();
                    $full_path_icon             =  $path . '\\' . $icon_name .'.'. Config::get('spr.type.mimeFile')[$icon_original_mime];

                    Image::make($icon)->save($full_path_icon, 100);
                    
                    $path_icon = Config::get('spr.system.uploadMedia.path_image_upload'). '/' . $icon_name .'.'. Config::get('spr.type.mimeFile')[$icon_original_mime];
                    $path_tmp_icon = Config::get('spr.system.uploadMedia.path_tmp_upload'). '/' . $icon_name .'.'. Config::get('spr.type.mimeFile')[$icon_original_mime];
                    
                    $data_icon = [
                        'name'  =>  $icon_name,
                        'type'  =>  $icon_original_mime,
                        'path'  =>  $path_icon,
                        'tmp_path'  =>  $path_icon,
                        'url'   => '',
                        'tmp_url' => ''

                    ];

                    $res_icon   =   $ModelMedia->insertData($data_icon);
                    if($res_icon['meta']['success'])  $data_update['icon'] = $res_icon['response'];
                }

                if($background_image != ''){

                    $background_name            =  'b_'.HelperController::uniqid_base36($data_output_validate_param['response']['created_at']);
                    $background_original_mime   =  $icon->getMimeType();
                    $full_path_background       = $path . '\\' . $background_name .'.'. Config::get('spr.type.mimeFile')[$background_original_mime];

                    Image::make($background_image)->save($full_path_background, 100);
                    $path = Config::get('spr.system.uploadMedia.path_image_upload'). '/' . $background_name .'.'. Config::get('spr.type.mimeFile')[$background_original_mime];
                    $path_tmp = Config::get('spr.system.uploadMedia.path_tmp_upload'). '/' . $background_name .'.'. Config::get('spr.type.mimeFile')[$background_original_mime];
                    
                    $data_background = [
                        'name'  =>  $background_name,
                        'type'  =>  $background_original_mime,
                        'path'  =>  $path,
                        'tmp_path'  =>  $path,
                        'url'   => '',
                        'tmp_url' => ''

                    ];

                    $res_bg     =   $ModelMedia->insertData($data_background);
                    if($res_bg['meta']['success'])  $data_update['background_image'] = $res_bg['response'];
                }
            }
            $data_output_validate_param =  $ModelProductCategories->updateData($data_update,$where);
            Cache::forget('product_categories');
        }

        return $data_output_validate_param;

    }

    public function getDataForLangCode($data_output_validate_param){

        $lang_code           =  $data_output_validate_param['response']['lang_code'];
        $parent_id           =  $data_output_validate_param['response']['id'];

        if ($data_output_validate_param['meta']['success']) {

            $ModelProductCategoryDetail = new ModelProductCategoryDetail();
            $where = [
                [
                    'fields' => 'product_category_id',
                    'operator' => '=',
                    'value' => $parent_id,
                ],
                [
                    'fields' => 'lang_code',
                    'operator' => '=',
                    'value' => $lang_code,
                ]
            ];

            $data_output_validate_param['response'] = $ModelProductCategoryDetail->getDataWithClause($where);

        }else{

            $data_output_validate_param['response'] = array();

        } 

        return  $data_output_validate_param;

    }
    public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {

            $ModelProductCategories = new ModelProductCategories();

            $data = $ModelProductCategories->getDataManage($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response'] = array();
            $data_output_validate_param['response']['data'] = [];
        }

        return $data_output_validate_param['response'];
    }

    public function getProductCategories($data_output_validate_param) {

        // $sort           = $data_output_validate_param['response']['sort'];
        // $limit          = $data_output_validate_param['response']['limit'];
        // $sort_type      = $data_output_validate_param['response']['sort_type'];
        // $key_search     = $data_output_validate_param['response']['key_search'];

        // if($data_output_validate_param['meta']['success']) {

        //     $ModelProductCategories = new ModelProductCategories();

        //     $data = $ModelProductCategories->getProductCategories();

        //     $data_output_validate_param['response']['data'] = $data;
        // }else {

        //     $data_output_validate_param['response'] = array();
        //     $data_output_validate_param['response']['data'] = [];
        // }

        // return $data_output_validate_param['response'];
    }
}
?>