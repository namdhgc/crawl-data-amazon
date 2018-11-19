<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\Support as ModelSupport;
use App\Http\Models\Media as ModelMedia;
use Spr\Base\Controllers\Helper as HelperController;
use Intervention\Image\Exception\NotReadableException;
use Spr\Base\Response\Response;
use Input;
use Config;
use Auth;
use Lang;
use Session;
use DB;
use Image;

class SupportController  extends Controller
{


    public function __construct()
    {

    }

    public function insertSupport($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $employee_name   =   $data_output_validate_param['response']['employee_name'];
            $field_support   =   $data_output_validate_param['response']['field_support'];
            $phone_support   =   $data_output_validate_param['response']['phone'];
            $avatar          =   $data_output_validate_param['response']['image'];
            $created_at      =   $data_output_validate_param['response']['created_at'];


            $ModelSupport    =   new ModelSupport();
            $ModelMedia      =   new ModelMedia();


            // INSERT AVATAR

            $mime_type = Config::get('spr.type.mimeFile');

            $image_name =  HelperController::uniqid_base36($data_output_validate_param['response']['created_at']);

            $image_original_mime = $avatar->getMimeType();

            $path_tmp = public_path( Config::get('spr.system.uploadMedia.path_tmp_upload') );
            $path     = public_path( Config::get('spr.system.uploadMedia.path_image_upload') );

            HelperController::create_path($path_tmp); 
            HelperController::create_path($path); 

            $full_path_file     = $path . '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];
            $full_path_file_tmp = $path_tmp . '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];


            // save file tmp
            Image::make($avatar)->save($full_path_file, 100);
            Image::make($avatar)->save($full_path_file_tmp, 100);

            $path = Config::get('spr.system.uploadMedia.path_image_upload'). '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];
            $path_tmp = Config::get('spr.system.uploadMedia.path_tmp_upload'). '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];

            $data_image = [

                'name'       =>  $image_name,
                'path'      =>  $path,
                'tmp_path'  =>  $path_tmp,
                'url'        =>  'url',
                'tmp_url'    =>  'tmp_url',
            ];

            $media_id   =     $ModelMedia->insertData($data_image);

            if($media_id['meta']['success']){


                $data = [

                    'employee_name'         =>  $employee_name,
                    'field_support'         =>  $field_support,
                    'phone'         =>  $phone_support,
                    'avatar'                =>  $media_id['response'],
                    'status'                =>  0,
                    'created_at'            =>  $created_at
                ];

                $data_output_validate_param = $ModelSupport->insertData($data);
            }

        }

        return $data_output_validate_param;

    }


    public function updateSupport($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $id              =   $data_output_validate_param['response']['id'];
            $employee_name   =   $data_output_validate_param['response']['employee_name'];
            $field_support   =   $data_output_validate_param['response']['field_support'];
            $phone_support   =   $data_output_validate_param['response']['phone'];
            $avatar          =   $data_output_validate_param['response']['image'];
            $updated_at      =   $data_output_validate_param['response']['created_at'];


            $ModelSupport    =   new ModelSupport();
            $ModelMedia      =   new ModelMedia();


            if($ModelSupport->checkRecordExist($id)['response']->total > 0){


                $avatar_old     =   $ModelSupport->getAvatarByID($id)['response']->avatar;

                if($avatar != null && $avatar !=""){

                    $mime_type = Config::get('spr.type.mimeFile');

                    $image_name =  HelperController::uniqid_base36($data_output_validate_param['response']['created_at']);

                    $image_original_mime = $avatar->getMimeType();

                    $path_tmp = public_path( Config::get('spr.system.uploadMedia.path_tmp_upload') );
                    $path     = public_path( Config::get('spr.system.uploadMedia.path_image_upload') );

                    HelperController::create_path($path_tmp); 
                    HelperController::create_path($path); 

                    $full_path_file     = $path . '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];
                    $full_path_file_tmp = $path_tmp . '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];


                    // save file tmp
                    Image::make($avatar)->save($full_path_file, 100);
                    Image::make($avatar)->save($full_path_file_tmp, 100);

                    $path = Config::get('spr.system.uploadMedia.path_image_upload'). '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];
                    $path_tmp = Config::get('spr.system.uploadMedia.path_tmp_upload'). '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];

                    $where_image    =   [

                        [
                            'fields'    =>  'id',
                            'operator'  =>  '=',
                            'value'     =>  $avatar_old,

                        ]

                    ];


                    $data_image     = [

                        'name'       =>  $image_name,
                        'path'      =>  $path,
                        'tmp_path'  =>  $path_tmp,
                        'url'        =>  'url',
                        'tmp_url'    =>  'tmp_url',
                        'updated_at' =>   $updated_at,     
                    ];

                    $update_avatar   =     $ModelMedia->updateData($data_image,$where_image);

                    if($update_avatar['meta']['success'] == false){

                        $data_output_validate_param['meta']['success']  = false;
                        $data_output_validate_param['meta']['code']     = 500;
                        $data_output_validate_param['meta']['msg']['error']      = Lang::get('message.web.error.0023');

                        return $data_output_validate_param;

                    }
                }


                $data = [

                    'employee_name'         =>  $employee_name,
                    'field_support'         =>  $field_support,
                    'phone'         =>  $phone_support,
                    'updated_at'            =>  $updated_at,
                ];

                $where  =   [

                    [
                        'fields'    =>  'id',
                        'operator'  =>  '=',
                        'value'     =>  $id,

                    ]

                ];

                $data_update = $ModelSupport->updateData($data,$where);

                if($data_update['meta']['success'] == false){

                    $data_output_validate_param['meta']['success']  = false;
                    $data_output_validate_param['meta']['code']     = 500;
                    $data_output_validate_param['meta']['msg']['error']      = [Lang::get('message.web.error.0018')];

                    return $data_output_validate_param;
                }

            }


        }

        $data_output_validate_param['meta']['msg']['success']   =   Lang::get('message.web.success.0001');
        return $data_output_validate_param;

    }

    public function deleteSupport($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $ModelSupport     =  new ModelSupport();

            $id             =   $data_output_validate_param['response']['id'];
            $deleted_at     =   $data_output_validate_param['response']['created_at'];
            

            $where = [

                [

                    'fields'    =>  'id',
                    'operator'  =>  '=',
                    'value'     =>  $id,
                ]

            ];

            $data = [
                'deleted_at'    =>  $deleted_at,
            ];

            $data_output_validate_param = $ModelSupport
            ->updateData($data,$where);

        }
        return $data_output_validate_param;
    
    }

    public function changeStatus($data_output_validate_param){


        if($data_output_validate_param['meta']['success']){

            $id             =   $data_output_validate_param['response']['id'];
            $updated_at     =   $data_output_validate_param['response']['updated_at'];
            $status         =   null;
            $ModelSupport   =   new ModelSupport();

            if($ModelSupport->checkRecordExist($id)['response']->total > 0){

                $status     =   $ModelSupport->getStatus($id)['response']->status;

                if($status == 0){

                    $status = 1;

                }else{

                    $status = 0;

                }

                $data = [

                    'status'        =>  $status,
                    'updated_at'    =>  $updated_at,
                ];

                $where = [

                    [

                        'fields'    =>  'id',
                        'operator'  =>  '=',
                        'value'     =>  $id,
                    ]

                ];

                $data_update    =   $ModelSupport->updateData($data,$where);

                if($data_update['meta']['success'] == false){

                    $data_output_validate_param['meta']['success']  = false;
                    $data_output_validate_param['meta']['code']     = 500;
                    $data_output_validate_param['meta']['msg']['error']      = [Lang::get('message.web.error.0018')];

                    return $data_output_validate_param;

                }else{

                    $data_output_validate_param['response']['status'] = $status;
                    $data_output_validate_param['meta']['msg']['success']   =   Lang::get('message.web.success.0001');
                }

            }

        }

        return $data_output_validate_param;
    }

    public function getData($data_output_validate_param){

        $results        = Response::response(); 
        
        if($data_output_validate_param['meta']['success']) {

            $sort           = $data_output_validate_param['response']['sort'];
            $sort_type      = $data_output_validate_param['response']['sort_type'];
            $limit          = $data_output_validate_param['response']['limit'];
            $key_search     = $data_output_validate_param['response']['key_search'];

            $ModelSupport        =  new ModelSupport();
   
            $where = [
                [

                    'fields'     =>     's.deleted_at',
                    'operator'   =>     'null',
                    'value'      =>     'NULL'
                ]
            ];

            $order = [
                [
                    'fields'    => $sort,
                    'operator'  => $sort_type
                ]
            ];

            $data = $ModelSupport->getData($where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order);

            $data_output_validate_param['response']['data']  = $data;

        }else {

            $data_output_validate_param['response']['data'] = array();

        }

        return $data_output_validate_param;

    }

}

?>