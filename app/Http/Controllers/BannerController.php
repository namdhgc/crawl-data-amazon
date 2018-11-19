<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\Banner as ModelBanner;
use App\Http\Models\BannerDetail as ModelBannerDetail;
use App\Http\Models\Slide as ModelSlide;
use App\Http\Models\Media as ModelMedia;
use Spr\Base\Controllers\Helper as HelperController;
use Spr\Base\Response\Response;
use Intervention\Image\Exception\NotReadableException;
use Input;
use Config;
use Auth;
use Lang;
use Session;
use Image;

class BannerController  extends Controller
{


    public function __construct()
    {

    }

    public function actionInsertOrUpdate($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']){

            $id                 =   $data_output_validate_param['response']['id'];
            $title              =   $data_output_validate_param['response']['title'];
            $description        =   $data_output_validate_param['response']['description'];
            //$lang_code          =   $data_output_validate_param['response']['lang_code'];
            $image              =   $data_output_validate_param['response']['image'];

            $ModelBanner    = new ModelBanner();
            $ModelMedia    = new ModelMedia();
            $where                  = [];

            if($image !=null && $image !=''){

                $mime_type = Config::get('spr.type.mimeFile');

                $image = $data_output_validate_param['response']['image'];

                $image_name =  HelperController::uniqid_base36($data_output_validate_param['response']['created_at']);

                $image_original_mime = $image->getMimeType();

                $path_tmp = public_path( Config::get('spr.system.uploadMedia.path_tmp_upload') );
                $path     = public_path( Config::get('spr.system.uploadMedia.path_image_upload') );

                HelperController::create_path($path_tmp);
                HelperController::create_path($path);

                $full_path_file     = $path . '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];
                $full_path_file_tmp = $path_tmp . '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];


                // save file tmp
                Image::make($image)->save($full_path_file, 100);
                Image::make($image)->save($full_path_file_tmp, 100);

                $path = Config::get('spr.system.uploadMedia.path_image_upload'). '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];
                $path_tmp = Config::get('spr.system.uploadMedia.path_tmp_upload'). '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];

                $data_image = [

                    'name'      =>  $image_name,
                    'path'      =>  $path,
                    'tmp_path'  =>  $path_tmp,
                    'url'       =>  'url',
                    'tmp_url'   =>  'tmp_url',
                ];

            }

            if($id != null && $id != ""){

                $where  =   [

                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $id
                    ]
                ];

                $data   =   [

                    'title'              => $title,
                    'description'        => $description,
                    //'lang_code'          => $lang_code

                ];
                if($image !=null && $image !=''){

                    $data_output_insert_media = $ModelMedia->insertData($data_image);
                    $data['media_id'] = $data_output_insert_media['response'];
                }

                $data_output_validate_param     =   $ModelBanner->updateData($data,$where);

            }else{

                $data   =   [

                    'title'             =>  $title,
                    'description'       =>  $description,
                    //'lang_code'         =>  $lang_code,

                ];
                if($image !=null && $image !=''){

                    $data_output_validate_param = $ModelMedia->insertData($data_image);

                    if($data_output_validate_param['meta']['success']==false){

                        $data_output_validate_param['meta']['success'] = false;
                        $data_output_validate_param['meta']['msg']['size']     = Lang::get('message.web.error.0024');
                        Session::flash('msg', $data_output_validate_param['meta']['msg']);

                        return $data_output_validate_param;

                    }else{

                        $data['media_id'] = $data_output_validate_param['response'];
                    }


                    if($data_output_validate_param['meta']['success'] == false){

                        $data_output_validate_param['meta']['success'] = false;
                        $data_output_validate_param['meta']['msg']['size']     = Lang::get('message.web.error.0017');
                        Session::flash('msg', $data_output_validate_param['meta']['msg']);

                        return $data_output_validate_param;

                    }

                    $data_output_validate_param     =   $ModelBanner->insertData($data,$where);
                }else {

                    $data_output_validate_param['meta']['success'] = false;
                    $data_output_validate_param['meta']['msg']['img']     = 'Vui lòng chọn ảnh icon cho banner';
                    Session::flash('msg', $data_output_validate_param['meta']['msg']);

                    return $data_output_validate_param;
                }

            }
            Session::flash('message','');

        }else{

            Session::flash('message', $data_output_validate_param['meta']['msg']);
        }

        return $data_output_validate_param;
    }

    public function deleteData($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $id             =   $data_output_validate_param['response']['id'];
            $deleted_at     =   $data_output_validate_param['response']['created_at'];

            $ModelBanner            =   new ModelBanner();
            $ModelBannerDetail      =   new ModelBannerDetail();

            $where = [
                [
                    'fields'    =>  'id',
                    'operator'  =>  '=',
                    'value'     =>  $id
                ]
            ];

            $where_detail = [
                [
                    'fields'    =>  'banner_id',
                    'operator'  =>  '=',
                    'value'     =>  $id
                ]
            ];


            $data = [

                'deleted_at'    =>  $deleted_at

            ];

            $result_sub = $ModelBannerDetail->updateData($data,$where_detail);


            if($result_sub['meta']['success']){

                $result = $ModelBanner->updateData($data,$where);

                if($result['meta']['success']){

                    $data_output_validate_param['meta']['msg']['delete'] = Lang::get('message.web.success.0004');

                }else{

                    $data_output_validate_param['meta']['msg']['delete'] = Lang::get('message.web.error.0019');

                }

            }else{

                $data_output_validate_param['meta']['msg']['delete'] = Lang::get('message.web.error.0019');

            }

        }

        Session::flash('message', $data_output_validate_param['meta']['msg']);
        return $data_output_validate_param;

    }

    public function getData($data_output_validate_param) {

        $results        = Response::response();

        $sort           = $data_output_validate_param['response']['sort'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $limit          = $data_output_validate_param['response']['limit'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {

            $ModelBanner        =  new ModelBanner();

            $where = [
                [

                    'fields'     =>     'b.deleted_at',
                    'operator'   =>     'null',
                    'value'      =>     'NULL'
                ],
                [
                    'operator' => 'raw',
                    'sql' =>  "(
                        title like '%".$key_search."%'

                        OR

                        b.description like '%".$key_search."%'
                    )"
                ]
            ];

            $order = [
                [
                    'fields'    => $sort,
                    'operator'  => $sort_type
                ]
            ];

            $data = $ModelBanner->getData($where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order);

            $data_output_validate_param['response']['data']  = $data;

        }else {

            $data_output_validate_param['response']['data'] = array();
        }
        return $data_output_validate_param;

    }

    public function getBanner($data_output_validate_param){

        $ModelBannerDetail  =   new ModelBannerDetail();
        $ModelBanner        =   new ModelBanner();
        $ModelSlide         =   new ModelSlide();
        $result             =   [];

        if($data_output_validate_param['meta']['success']){

            $res_banner     =   $ModelBanner->getBanner();

            if($res_banner['meta']['success'] && !empty($res_banner['response'])){

                foreach ($res_banner['response'] as $key => $value)
                {

                    $tmp                =   [];
                    $res_banner_detail  =   $ModelBannerDetail->getDataByParentId($value->id);
                    $res_slide          =   $ModelSlide->getImageSlideByBanner($value->id);

                    $tmp['id']                  =   $value->id;
                    $tmp['title']               =   $value->title;
                    $tmp['description']         =   $value->description;
                    $tmp['path']               =   $value->path;

                    if($res_banner_detail['meta']['success'] && $res_slide['meta']['success']){

                        $tmp['banner']   =   $res_banner_detail['response'];
                        $tmp['slide']    =   $res_slide['response'];

                        $result[] = $tmp;
                    }
                }

                $data_output_validate_param['response'] = $result;
            }

        }

        return $data_output_validate_param;

    }
}
?>