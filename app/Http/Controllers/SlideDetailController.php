<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\Media as ModelMedia;
use App\Http\Models\SlideDetail as ModelSlideDetail;
use Spr\Base\Controllers\Helper as HelperController;
use Spr\Base\Response\Response;
use Intervention\Image\Exception\NotReadableException;
use Spr\Base\Validates\ValidateUrl;
use Input;
use Config;
use Auth;
use Lang;
use Session;
use Image;

class SlideDetailController  extends Controller
{

    protected $table_slide_detail = 'slide_detail';

    public function __construct()
    {

    }


    public function getData($data_output_validate_param) {

		$sort           = $data_output_validate_param['response']['sort'];
        $slide_id       = $data_output_validate_param['response']['slide_id'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $limit          = $data_output_validate_param['response']['limit'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        $data_output_validate_param['response']['data'] = array();

        if($data_output_validate_param['meta']['success']) {

            $where = [
                [
                    'fields'     =>     's.slide_id',
                    'operator'   =>     '=',
                    'value'      =>     $slide_id
                ],
                [

                    'fields'     =>     's.deleted_at',
                    'operator'   =>     'null'
                ],
                [
                    'fields' => 's.title',
                    'operator' => 'like',
                    'value' => '%'. $key_search . '%',
                ],
            ];

            $ModelSlideDetail = new ModelSlideDetail();

            $order = [
                [
                    'fields'    => $sort,
                    'operator'  => $sort_type
                ]
            ];

            $data = $ModelSlideDetail->getData($where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order);

            $data_output_validate_param['response']['data']  = $data;


        }
        
        return $data_output_validate_param;
    }

    public function actionInsertOrUpdate($data_output_validate_param) {

        // dd($data_output_validate_param);
        $ModelMedia         = new ModelMedia();
        $ModelSlideDetail   = new ModelSlideDetail();
        $MediaController    = new MediaController();

       if($data_output_validate_param['meta']['success']){

            $id                 =   $data_output_validate_param['response']['id'];
            $slide_id           =   $data_output_validate_param['response']['slide_id'];
            $image              =   $data_output_validate_param['response']['image'];
            $title              =   $data_output_validate_param['response']['title'];
            $link               =   $data_output_validate_param['response']['link'];
            $media_id           =   $data_output_validate_param['response']['media_id'];
            $mod_link           =   null;
            $where              =   [];
            $where_image        =   [];
            $data_image         =   [];
            $data               =   [];

            $validate           =  new ValidateUrl();
            $checkUrl           =  $validate->checkUrl($link);

            if($checkUrl['meta']['success']){

                $mod_link   =   $checkUrl['response'];

                if ($id != null && $id != '') {
                    
                    // update
                    $where = [
                        [
                            'fields'    => 'id',
                            'operator'  => '=',
                            'value'     => $id
                        ]
                    ];

                    $data_slide_detail = [
                        'slide_id'      => $slide_id,
                        'title'         => $title,
                        'link'          => $link,
                        'mod_link'      => $mod_link,
                        'updated_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString())
                    ];

                    if (isset($image) && $image != null) {
                        
                        $image_id = $MediaController->imageUpload($data_output_validate_param)['response']['data']['response'];
                        $data_slide_detail['image_id'] = $image_id;
                    }

                    $slide_detai = ModelSlideDetail::updateData($this->table_slide_detail, $data_slide_detail, $where);

                } else {
                    
                    // insert
                    $where = [];

                    $image_id = $MediaController->imageUpload($data_output_validate_param)['response']['data']['response'];

                    $data_slide_detail = [
                        'slide_id'      => $slide_id,
                        'image_id'      => $image_id,
                        'title'         => $title,
                        'link'          => $link,
                        'mod_link'      => $mod_link,
                        'created_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString())
                    ];

                    $slide_detai = ModelSlideDetail::insertData($this->table_slide_detail, $data_slide_detail, $where);

                    $data_output_validate_param['meta']['code'] = 200;
                    $data_output_validate_param['meta']['msg']  = ['Successful'];
                }

                

            }else{
                $data_output_validate_param['meta']['msg']['link']  =   $checkUrl['meta']['msg'];
                $data_output_validate_param['meta']['success']      =   false;
                Session::flash('msg', $data_output_validate_param['meta']['msg']);
            }
        }

        return $data_output_validate_param;
    }
}
?>