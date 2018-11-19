<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\Navigation as ModelNavigation;
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

class NavigationController  extends Controller
{


    public function __construct()
    {

    }

    public function insertData($data_output_validate_param){

    	if($data_output_validate_param['meta']['success']){

            $link           =   $data_output_validate_param['response']['link'];
            $title          =   $data_output_validate_param['response']['title'];
            $description    =   $data_output_validate_param['response']['description'];
            $lang_code      =   $data_output_validate_param['response']['lang_code'];
            $image          =   $data_output_validate_param['response']['image'];
            $display        =   $data_output_validate_param['response']['display'];
            $created_at     =   $data_output_validate_param['response']['created_at'];
            $display        =   (int)$display;
            $max_display    =   Config::get('spr.system.nav_config.max_display');

            $ModelNavigation    =   new ModelNavigation();
            $ModelMedia         =   new ModelMedia(); 


            if($display < 0 || $display > 1){

                $data_output_validate_param['meta']['success']  = false;
                $data_output_validate_param['meta']['msg']      = Lang::get('message.web.error.0013');
                Session::flash('message', $data_output_validate_param['meta']['msg']);

                return $data_output_validate_param;

            }

            if( $display == 1 &&  $ModelNavigation->totalActive($lang_code)['response']->total == $max_display){

                $data_output_validate_param['meta']['success'] = false;

                $data_output_validate_param['meta']['msg']['display'] = Lang::get('message.web.error.0012');

                Session::flash('message', $data_output_validate_param['meta']['msg']);

                return $data_output_validate_param;

            }

            $mime_type = Config::get('spr.type.mimeFile');

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

                'name'       =>  $image_name,
                'path'      =>  $path,
                'tmp_path'  =>  $path_tmp,
                'url'        =>  'url',
                'tmp_url'    =>  'tmp_url',
            ];

            $media_id = $ModelMedia->insertData($data_image);

            if($media_id['meta']['success']){

                $data = [

                    'title'         =>  $title,
                    'link'          =>  $link,
                    'description'   =>  $description,
                    'lang_code'     =>  $lang_code,
                    'display'       =>  $display,
                    'media_id'      =>  $media_id['response'],
                    'created_at'    =>  $created_at,
                ];

                $data_output_validate_param = $ModelNavigation->insertData($data);

            }else{

                 $data_output_validate_param  =  $media_id;
            }


    	}else{

            $data_output_validate_param['response'] = array();
            
    	}
        
        Session::flash('message', $data_output_validate_param['meta']['msg']);

    	return $data_output_validate_param;

    }

    public function updateData($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $id             =   $data_output_validate_param['response']['id'];
            $link           =   $data_output_validate_param['response']['link'];
            $title          =   $data_output_validate_param['response']['title'];
            $description    =   $data_output_validate_param['response']['description'];
            $image          =   $data_output_validate_param['response']['image'];
            $display        =   $data_output_validate_param['response']['display'];
            $media_id       =   $data_output_validate_param['response']['media_id'];
            $updated_at     =   $data_output_validate_param['response']['updated_at'];
            $lang_code      =   $data_output_validate_param['response']['lang_code'];
            $max_display    =   Config::get('spr.system.nav_config.max_display');

            $ModelNavigation    =   new ModelNavigation();
            $ModelMedia         =   new ModelMedia(); 
            $id_image           =   null;
            $display = (int)$display;

            $where              =   [

                [
                    'fields'    =>  'id',
                    'operator'  =>  '=',
                    'value'     =>  $id,
                ]

            ];

            $data = [

                'title'         =>  $title,
                'link'          =>  $link,
                'lang_code'     =>  $lang_code,
                'description'   =>  $description,
                'display'       =>  $display,
                'updated_at'    =>  $updated_at,
            ];

            if($ModelNavigation->checkIdExist($id)['response']->total == 0){

                $data_output_validate_param['meta']['success']  = false;
                $data_output_validate_param['meta']['msg']      = Lang::get('message.web.error.0011');
                Session::flash('message', $data_output_validate_param['meta']['msg']);

                return $data_output_validate_param;

            }

            if($display < 0 || $display > 1){

                $data_output_validate_param['meta']['success']  = false;
                $data_output_validate_param['meta']['msg']      = Lang::get('message.web.error.0013');
                Session::flash('message', $data_output_validate_param['meta']['msg']);

                return $data_output_validate_param;

            }else{

                if($display == 1 && $ModelNavigation->checkIsActive($id)['response']->total == 1){


                    $display = 0;

                }

                if($display == 0 && $ModelNavigation->checkIsActive($id)['response']->total == 0){

                    $display = 1;

                }

            }

            if( $display == 1 && 
                $ModelNavigation->checkIsActive($id)['response']->total ==0 && 
                $ModelNavigation->totalActive($lang_code)['response']->total ==$max_display){

                $data_output_validate_param['meta']['success'] = false;

                $data_output_validate_param['meta']['msg']['display'] = Lang::get('message.web.error.0012');

                Session::flash('message', $data_output_validate_param['meta']['msg']);

                return $data_output_validate_param;

            }


            if($image !=null && $image != ''){

                $mime_type = Config::get('spr.type.mimeFile');

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

                $where_image = [
                    [
                        'fields'    =>  'id',
                        'operator'  =>  '=',
                        'value'     =>  $media_id
                    ]
                ];

                $id_image = $ModelMedia->updateData($data_image,$where_image);

                 if($id_image['meta']['success']){

                        $data_output_validate_param = $ModelNavigation->updateData($data,$where);

                 }else{

                    $data_output_validate_param = $id_image;
                 }

            }else{

                $data_output_validate_param = $ModelNavigation->updateData($data,$where);
            }    

        }else{

            $data_output_validate_param['response'] = array();
           
        }
         Session::flash('message', $data_output_validate_param['meta']['msg']);
        return $data_output_validate_param;
    }

    public function deleteData($data_output_validate_param){

		if($data_output_validate_param['meta']['success']){

            $ModelNavigation     =  new ModelNavigation();

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

            $data_output_validate_param = $ModelNavigation->updateData($data,$where);

    	}
    	return $data_output_validate_param;
    }

    public function changeActive($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){


            $id             =   $data_output_validate_param['response']['id'];
            $display        =   $data_output_validate_param['response']['display'];
            $updated_at     =   $data_output_validate_param['response']['updated_at'];
            $lang_code      =   $data_output_validate_param['response']['lang_code'];
            $max_display    =   Config::get('spr.system.nav_config.max_display');

            $display = (int)$display;



            $ModelNavigation =  new ModelNavigation();

            if($ModelNavigation->checkIdExist($id)['response']->total == 0){

                $data_output_validate_param['meta']['success']  = false;
                $data_output_validate_param['meta']['msg']['exist']      = Lang::get('message.web.error.0011');

                return $data_output_validate_param;

            }

            if($display < 0 || $display > 1){

                $data_output_validate_param['meta']['success']  = false;
                $data_output_validate_param['meta']['msg']['exist']      = Lang::get('message.web.error.0013');

                return $data_output_validate_param;

            }else{

                if($display == 1 && $ModelNavigation->checkIsActive($id)['response']->total == 1){


                    $display = 0;

                }

                if($display == 0 && $ModelNavigation->checkIsActive($id)['response']->total == 0){

                    $display = 1;

                }

            }

            if($display == 1 && 
                        $ModelNavigation->checkIsActive($id)['response']->total ==0 && 
                        $ModelNavigation->totalActive($lang_code)['response']->total ==$max_display){

                        $data_output_validate_param['meta']['success'] = false;
                        $data_output_validate_param['meta']['msg']['display']   = Lang::get('message.web.error.0012');

                        return $data_output_validate_param;

            }

            $where = [

                [
                    'fields'    =>  'id',
                    'operator'  =>  '=',
                    'value'     =>  $id,

                ]
            ];

            $data = [

                'display'       =>  $display,
                'updated_at'    =>  $updated_at
            ];

            $data  = $ModelNavigation->updateData($data,$where);

            if($data['meta']['success'])
            {
                $data_output_validate_param['meta']['msg']['update']        =   Lang::get('message.web.success.0001');
                $data_output_validate_param['response']['display']          =   $display;

            }  

        }

        return $data_output_validate_param;

    }

    public function getData($data_output_validate_param){

		$results 		= Response::response(); 

		$sort           = $data_output_validate_param['response']['sort'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $limit          = $data_output_validate_param['response']['limit'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {
 
                $ModelNavigation = new ModelNavigation();

                $where = [
                    [
                        'fields'    =>  'n.title',
                        'operator'  =>  'like',
                        'value'     =>  '%'. $key_search . '%',
                    ],
                    [
                        'fields'    =>  'n.deleted_at',
                        'operator'  =>  'null',
                        'value'     =>  'NULL'
                    ]
                ];

                $order = [
                    [
                        'fields'    => $sort,
                        'operator'  => $sort_type
                    ]
                ];

                $data = $ModelNavigation->getData($where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order);

                $data_output_validate_param['response']['data']  = $data;

        }else {

            $data_output_validate_param['response']['data'] = array();
        }
        return $data_output_validate_param;

    }

    public function getDataForClient($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $lang_code  =   $data_output_validate_param['response']['lang_code'];

            $ModelNavigation    =   new ModelNavigation();

            $data_output_validate_param['response']['data'] =   $ModelNavigation->getDataForClient($lang_code);

        }else{

            $data_output_validate_param['response']['data'] = array();

        }

        return $data_output_validate_param;
    }
}    