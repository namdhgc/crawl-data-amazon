<?php

namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\Media as ModelMedia;
use App\Http\Models\Slide as ModelSlide;
use App\Http\Models\SlideDetail as ModelSlideDetail;
use App\Http\Controllers\MediaController as MediaController;
// use Intervention\Image\Exception\NotReadableException;
use Hash;
use Input;
use Image;
use Config;
use File;
use Auth;
use Lang;
use Session;

class SlideController extends Controller
{

    protected $table_slide          = "slide";
    protected $table_media          = "media";
    protected $table_slide_detail   = "slide_detail";

    public function __construct()
    {

    }



    public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {

            $ModelSlide = new ModelSlide();

            $data = $ModelSlide->getDataManage($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response']['data'] = array();
        }

        return $data_output_validate_param;
    }

    public function updateSlide($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

            $id             = $data_output_validate_param['response']['id'];
            $title          = $data_output_validate_param['response']['title'];
            $description    = $data_output_validate_param['response']['description'];
            $link           = $data_output_validate_param['response']['link'];


            $ModelSlide         = new ModelSlide();
            $ModelSlideDetail   = new ModelSlideDetail();

            $where_slide = [
                [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id
                ]
            ];

            $data_slide = [
                'title'         => $title,
                'description'   => $description
            ];

            $data_slide_detail = [
                'link'         => $link
            ];

            $where_slide_detail = [
                [
                    'fields'    => 'slide_id',
                    'operator'  => '=',
                    'value'     => $id
                ]
            ];

            $slide              = $ModelSlide->updateData($this->table_slide, $data_slide, $where_slide);
            $slide_detai        = $ModelSlideDetail->updateData($this->table_slide_detail, $data_slide_detail, $where_slide_detail);

        } else {

            $data_output_validate_param['response'] = array();
            $data_output_validate_param['response']['data'] = $data_output_validate_param;
        }

        return $data_output_validate_param;
    }

    public function getImageInformation($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

            $id     = $data_output_validate_param['response']['id'];

            $ModelSlide = new ModelSlide();
            $data       = $ModelSlide->getImageInformation($id);

            $data_output_validate_param['response'] = $data;
        }

        return $data_output_validate_param;
    }

    public function deleteImage($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

            $data   = [];
            $id     = $data_output_validate_param['response']['id'];

            // $where_slide = [
            //     [
            //         'fields'    => 'id',
            //         'operator'  => '=',
            //         'value'     => $id
            //     ]
            // ];

            $where_slide_detail = [
                [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id
                ]
            ];

            $data['deleted_at'] = strtotime(\Carbon\Carbon::now()->toDateTimeString());

            // $ModelSlide         = new ModelSlide();
            $ModelSlideDetail   = new ModelSlideDetail();
            // $ModelMedia         = new ModelMedia();

            // $slide              = $ModelSlide->updateData($this->table_slide, $data, $where_slide);
            $slide_detai        = $ModelSlideDetail->updateData($this->table_slide_detail, $data, $where_slide_detail);
            // $datediaa           = $ModelMedia->updateData($this->table_media, $data, $where);

            $data_output_validate_param['response'] = $data;
        }

        return $data_output_validate_param;
    }

    public function actionInsertOrUpdate($data_output_validate_param) {
        if($data_output_validate_param['meta']['success']){

            $id                 =   $data_output_validate_param['response']['id'];
            $title              =   $data_output_validate_param['response']['title'];
            $description        =   $data_output_validate_param['response']['description'];
            $type               =   $data_output_validate_param['response']['type'];
            $banner_id          =   $data_output_validate_param['response']['banner_id'];
            $type               = ($type == "on")? 1 : 0;

            if ($banner_id == '' || $banner_id == null || empty($banner_id) || $type == 1) {

                $banner_id = null;
            }

            $ModelSlide         = new ModelSlide();
            $where              = [];

            if($id != null && $id != ""){

                $where  =   [
                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $id
                    ]
                ];

                $data   =   [
                    'title'             => $title,
                    'type'              => $type,
                    'description'       => $description,
                    'banner_id'         => $banner_id,
                    'updated_at'        => strtotime(\Carbon\Carbon::now()->toDateTimeString()),
                    'status'            => 0
                ];


                $data_output_validate_param     =   $ModelSlide->updateData($this->table_slide, $data,$where);

            }else{

                $data   =   [
                    'title'             => $title,
                    'type'              => $type,
                    'description'       => $description,
                    'banner_id'         => $banner_id,
                    'created_at'        => strtotime(\Carbon\Carbon::now()->toDateTimeString())
                ];


                $data_output_validate_param     =   $ModelSlide->insertData($this->table_slide, $data,$where);
            }
            Session::flash('message','');

        }else{

            Session::flash('message', $data_output_validate_param['meta']['msg']);
        }

        return $data_output_validate_param;
    }

    public function deleteData($data_output_validate_param){

        $id =   $data_output_validate_param['response']['id'];

        $ModelSlide            =   new ModelSlide();
        $ModelSlideDetail      =   new ModelSlideDetail();


        if($data_output_validate_param['meta']['success']){

            $where = [
                [
                    'fields'    =>  'id',
                    'operator'  =>  '=',
                    'value'     =>  $id
                ]
            ];

            $where_detail = [
                [
                    'fields'    =>  'slide_id',
                    'operator'  =>  '=',
                    'value'     =>  $id
                ]
            ];


            $data = [

                'deleted_at'    =>  strtotime(\Carbon\Carbon::now()->toDateTimeString())

            ];

            $data_output_validate_param = $ModelSlideDetail->updateData($this->table_slide_detail, $data,$where_detail);


            if($data_output_validate_param['meta']['success']){

                $data_output_validate_param = $ModelSlide->updateData($this->table_slide, $data,$where);
            }

        }

        return $data_output_validate_param;
    }

    public function updateStatus($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']){

            $ModelSlide         =   new ModelSlide();
            $id                 =   $data_output_validate_param['response']['id'];
            $status             =   $data_output_validate_param['response']['status'];
            $updated_at         =   $data_output_validate_param['response']['updated_at'];
            $where = [
                [
                    'fields'    =>  'id',
                    'operator'  =>  '=',
                    'value'     =>  $id
                ]
            ];

            $record = $ModelSlide->checkExistsRecord($id);

            if($record['response'] != null){

                $check_main     =   $ModelSlide->checkIsmain($id);
                $checkIsStatus  =   $ModelSlide->checkIsStatus($id);

                if($status != 0 && $status !=1 ){

                    $data_output_validate_param['meta']['success']          = false;
                    $data_output_validate_param['meta']['code']             = 500;
                    $data_output_validate_param['meta']['msg']['display']   = Lang::get('message.web.error.0013');

                    return $data_output_validate_param;

                }else{

                    if($status == 1){

                        $status = 0;

                    }else{

                        $status = 1;

                    }
                }

                $data   =   [

                        'status'        =>  $status,
                        'updated_at'    =>  $updated_at,
                ];


                if($check_main['response']->banner_id == null){

                    $status_main    =   $ModelSlide->statusMain();
                    $is_status      =   $checkIsStatus['response']->status;

                    if($status_main['response']->total > 0 && $is_status == 0 && $status ==1){

                        $data_upeate_to_default_main_slide = [

                            'status'        =>  0,
                            'updated_at'    =>  $updated_at
                        ];

                        $where_update_status_to_default_main_slide = [

                            [
                                'fields' => 'banner_id',
                                'operator' => 'null'
                            ]
                        ];

                        $ModelSlide->updateData($this->table_slide, $data_upeate_to_default_main_slide,$where_update_status_to_default_main_slide);

                    }

                }else{

                    $status_banner      =   $ModelSlide->statusBannerGroupByBannerID($check_main['response']->banner_id);
                    $is_status          =   $checkIsStatus['response']->status;

                    if($status_banner['response']->total > 0 && $is_status == 0 && $status == 1){

                        $data_upeate_to_default_banner_slide = [

                            'status'        =>  0,
                            'updated_at'    =>  $updated_at
                        ];

                        $where_update_status_to_default_banner_slide = [

                            [
                                'fields' => 'banner_id',
                                'operator' => '=',
                                'value'     => $check_main['response']->banner_id
                            ]
                        ];

                        $ModelSlide->updateData($this->table_slide, $data_upeate_to_default_banner_slide,$where_update_status_to_default_banner_slide);

                    }

                }

                $results = $ModelSlide->updateData($this->table_slide, $data,$where);
                $data_output_validate_param['response']['id']       = $id;
                $data_output_validate_param['response']['status']   = $status;

                if($status ==0){

                    $data_output_validate_param['response']['title']    = Lang::get('slide.inactive');

                }else{

                    $data_output_validate_param['response']['title']    = Lang::get('slide.active');
                }


            }else{

                $data_output_validate_param['meta']['success']          = false;
                $data_output_validate_param['meta']['code']             = 500;
                $data_output_validate_param['meta']['msg']['display']   = Lang::get('message.web.error.0011');
                return  $data_output_validate_param;
            }
        }
        return $data_output_validate_param;
    }

    public function getActiveMainSlide($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $ModelSlide     =   new ModelSlide();

            $data_output_validate_param = $ModelSlide->selectMainSlide();
        } else {

            $data_output_validate_param['response'] = array();
            $data_output_validate_param['response']['data'] = $data_output_validate_param;
        }

        return $data_output_validate_param;
    }

    public function getImageSlideByBanner($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $banner_id      = $data_output_validate_param['response']['banner_id'];
            $ModelSlide     = new ModelSlide();

            $results = $ModelSlide->getImageSlideByBanner($banner_id);

            $data_output_validate_param['response']['data'] = $results;
        } else {

            $data_output_validate_param['response'] = array();
            $data_output_validate_param['response']['data'] = $data_output_validate_param;
        }

        return $data_output_validate_param;
    }

}