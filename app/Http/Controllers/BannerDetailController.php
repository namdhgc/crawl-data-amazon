<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\BannerDetail as ModelBannerDetail;
use App\Http\Models\Banner as ModelBanner;
use App\Http\Models\Media as ModelMedia;
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

class BannerDetailController  extends Controller
{


    public function __construct()
    {

    }

    public function actionInsertOrUpdate($data_output_validate_param) {


       if($data_output_validate_param['meta']['success']){

            $id                 =   $data_output_validate_param['response']['id'];
            $banner_id          =   $data_output_validate_param['response']['banner_id'];
            $image              =   $data_output_validate_param['response']['image'];
            $size               =   $data_output_validate_param['response']['size'];
            $link               =   $data_output_validate_param['response']['link'];
            $media_id           =   $data_output_validate_param['response']['media_id'];
            $created_at         =   $data_output_validate_param['response']['created_at'];
            $updated_at         =   $data_output_validate_param['response']['updated_at'];
            $where              =   [];
            $where_image        =   [];
            $data_image         =   [];
            $data               =   [];

            $validate           =  new ValidateUrl();
            $checkUrl           =  $validate->checkUrl($link);
            if($checkUrl['meta']['success']){

                $ModelBannerDetail  =  new ModelBannerDetail();
                $ModelMedia         =  new ModelMedia();

                $total_size     =   $ModelBannerDetail->getTotalSize($banner_id);
                $size_large     =   $ModelBannerDetail->checkSizeLarge($banner_id);
                $max_size       =   (int)Config::get('spr.system.size.max');

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

                if($id != null && $id != ''){

                    $curr_size      = $ModelBannerDetail->getSizeById($id);

                    $size_remain    = ($max_size + $curr_size['response']->size) - ($total_size['response']->total + $size);

                    if($size_remain >= 0){

                        if($size == 2 &&  $size_remain < 0){

                            $data_output_validate_param['meta']['success'] = false;
                            $data_output_validate_param['meta']['msg']['size']     = Lang::get('message.web.error.0022');
                            Session::flash('msg', $data_output_validate_param['meta']['msg']);

                            return $data_output_validate_param; 

                        }else{

                            $data['size']   =   $size;
                        }

                    }else{

                        $data_output_validate_param['meta']['success'] = false;
                        $data_output_validate_param['meta']['msg']['size']     = Lang::get('message.web.error.0022');
                        Session::flash('msg', $data_output_validate_param['meta']['msg']); 

                        return $data_output_validate_param;

                    }


                    $where = [

                        [
                            'fields'     => 'id',
                            'operator'  => '=',
                            'value'      => $id  
                        ]
                    ];

                    $data['mod_link']           =   $checkUrl['response'];
                    $data['link']               =   $link;
                    $data['updated_at']         =   $updated_at;

                    if($image !=null && $image !=''){

                        $where_image = [
                            [
                                'fields'     => 'id',
                                'operator'  => '=',
                                'value'      => $media_id
                            ]

                        ];

                        $data_output_validate_param = $ModelMedia->updateData($data_image,$where_image);

                        if($data_output_validate_param['meta']['success']==false){

                            $data_output_validate_param['meta']['success'] = false;
                            $data_output_validate_param['meta']['msg']['size']     = Lang::get('message.web.error.0023');
                            Session::flash('msg', $data_output_validate_param['meta']['msg']); 

                            return $data_output_validate_param;

                        }


                    }

                    $data_output_validate_param = $ModelBannerDetail->updateData($data,$where);
                    if($data_output_validate_param['meta']['success']==false){

                        $data_output_validate_param['meta']['success'] = false;
                        $data_output_validate_param['meta']['msg']['size']     = Lang::get('message.web.error.0018');
                        Session::flash('msg', $data_output_validate_param['meta']['msg']); 

                        return $data_output_validate_param;

                    }

                }else{


                    $size_remain    =   $max_size - $total_size['response']->total;

                    if($size_remain > 0 ){

                        $data = [

                            'link'          =>  $link,
                            'mod_link'      =>  $checkUrl['response'],
                            'banner_id'     =>  $banner_id,
                            'created_at'    =>  $created_at,
                        ];


                        if($size <= $size_remain){

                            if($size == 2 && ($total_size['response']->total + $size) > $max_size ){

                                $data_output_validate_param['meta']['success'] = false;
                                $data_output_validate_param['meta']['msg']['size']     = Lang::get('message.web.error.0022');
                                Session::flash('msg', $data_output_validate_param['meta']['msg']);

                                return $data_output_validate_param;

                            }else{

                                $data['size']   =   $size;
                            }


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

                                $data_output_validate_param = $ModelBannerDetail->insertData($data);

                            }

                        }else{

                                $data_output_validate_param['meta']['success'] = false;
                                $data_output_validate_param['meta']['msg']['size']     = Lang::get('message.web.error.0022');;
                                Session::flash('msg', $data_output_validate_param['meta']['msg']); 
                                return $data_output_validate_param; 
                        }

                    }else{
                                $data_output_validate_param['meta']['success'] = false;
                                $data_output_validate_param['meta']['msg']['size']     = Lang::get('message.web.error.0022');;
                                Session::flash('msg', $data_output_validate_param['meta']['msg']); 
                                return $data_output_validate_param;                      
                    }                                   

                }
                Session::flash('msg', '');
            
            }else{

                $data_output_validate_param['meta']['msg']['link']  =   $checkUrl['meta']['msg'];
                $data_output_validate_param['meta']['success']      =   false;
                Session::flash('msg', $data_output_validate_param['meta']['msg']);

            }   

        }else{
            Session::flash('msg', $data_output_validate_param['meta']['msg']);
        }
        return $data_output_validate_param;
    }


    public function deleteData($data_output_validate_param){

        $id             =   $data_output_validate_param['response']['id'];
        $deleted_at     =   $data_output_validate_param['response']['created_at'];

        $ModelBannerDetail =  new ModelBannerDetail();

        if($data_output_validate_param['meta']['success']){

            $where = [
                [
                    'fields'    =>  'id',
                    'operator'  =>  '=',
                    'value'     =>  $id
                ]
            ];

            $data = [   

                'deleted_at'    =>  $deleted_at

            ];

            $data_output_validate_param = $ModelBannerDetail->updateData($data,$where);
        }

        return $data_output_validate_param;

    }
    
    public function getData($data_output_validate_param) {

        $results        = Response::response(); 

        $sort           = $data_output_validate_param['response']['sort'];
        $banner_id      = $data_output_validate_param['response']['banner_id'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $limit          = $data_output_validate_param['response']['limit'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {

            $ModelBanner        =  new ModelBanner();

            if($ModelBanner->checkIdExist($banner_id)['response']->total > 0)
            {    
                $ModelBannerDetail = new ModelBannerDetail();

                $where = [
                    [
                        'fields'     =>     'b.banner_id',
                        'operator'   =>     '=',
                        'value'      =>     $banner_id
                    ],
                    [

                        'fields'     =>     'b.deleted_at',
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

                $data = $ModelBannerDetail->getData($where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order);

                $data_output_validate_param['response']['data']  = $data;
                $data_output_validate_param['response']['banner_id']  = $banner_id;

            }else{

                $data_output_validate_param['meta']['success'] = false;
                $data_output_validate_param['meta']['code'] = 404;

            }


        }else {

            $data_output_validate_param['response']['data'] = array();
            $data_output_validate_param['response']['banner_id']  = $banner_id;
        }
        return $data_output_validate_param;

    }

}
?>