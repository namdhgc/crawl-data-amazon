<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\Media as ModelMedia;
use App\Http\Models\Setting as ModelSetting;
use Spr\Base\Controllers\Helper as HelperController;
use Spr\Base\Response\Response;
use Intervention\Image\Exception\NotReadableException;
use Input;
use Config;
use Auth;
use Lang;
use Session;
use Image;

class SettingController  extends Controller
{


    public function __construct()
    {

    }

    public function insertData($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $title          =   $data_output_validate_param['response']['title'];
            $key            =   $data_output_validate_param['response']['key'];
            $description    =   $data_output_validate_param['response']['description'];
            $icon           =   $data_output_validate_param['response']['image'];
            $icon_class     =   $data_output_validate_param['response']['icon_class'];
            $created_at     =   $data_output_validate_param['response']['created_at'];

            $ModelSetting    =   new ModelSetting();
            $ModelMedia         =   new ModelMedia(); 

            $mime_type = Config::get('spr.type.mimeFile');

            $image_name =  HelperController::uniqid_base36($data_output_validate_param['response']['created_at']);

            $image_original_mime = $icon->getMimeType();

            $path_tmp = public_path( Config::get('spr.system.uploadMedia.path_tmp_upload') );
            $path     = public_path( Config::get('spr.system.uploadMedia.path_image_upload') );

            HelperController::create_path($path_tmp); 
            HelperController::create_path($path); 

            $full_path_file     = $path . '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];
            $full_path_file_tmp = $path_tmp . '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];


            // save file tmp
            Image::make($icon)->save($full_path_file, 100);
            Image::make($icon)->save($full_path_file_tmp, 100);

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
                    'key'           =>  $key,
                    'description'   =>  $description,
                    'icon'          =>  $media_id['response'],
                    'icon_class'    =>  $icon_class,
                    'created_at'    =>  $created_at,
                ];

                $data_output_validate_param = $ModelSetting->insertData($data);

            }else{

                 $data_output_validate_param  =  $media_id;
            }


        }else{

            $data_output_validate_param['response'] = array();
            
        }
        
        Session::flash('message', $data_output_validate_param['meta']['msg']);

        return $data_output_validate_param;

    }

    public function updateCompanyInfo($data_output_validate_param){


        if ($data_output_validate_param['meta']['success']) {


            $image                          =   $data_output_validate_param['response']['image'];
           // $media_id                           =   $data_output_validate_param['response']['icon'];
            
            $company_name                   =   $data_output_validate_param['response']['company_name'];
            $email_support                  =   $data_output_validate_param['response']['email_support'];
            $hotline                        =   $data_output_validate_param['response']['hotline'];
            $total_products                 =   $data_output_validate_param['response']['total_products'];
            $total_transaction_success      =   $data_output_validate_param['response']['transaction_success'];
            $description                    =   $data_output_validate_param['response']['description'];
            $updated_at                     =   $data_output_validate_param['response']['updated_at'];
            $icon                           =   null;
            $data                           =   [];
            $where                          =   [];

            $ModelSetting                   =   new ModelSetting();

            if($image != '' && $image != null){

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


                $key_logo   =   Config::get('spr.type.setting.company-info.logo.key');
                $ModelMedia =   new ModelMedia();

                $data_media = [

                        'name'          =>  $image_name,
                        'path'         =>  $path,
                        'tmp_path'     =>  $path_tmp,
                        'url'           =>  'url',
                        'tmp_url'       =>  'tmp_url',
                    ];

                if(!empty($ModelSetting->checkKeyExist($key_logo)['response'])){

                    $icon       =   $ModelSetting->checkKeyExist($key_logo)['response']->icon;
                    
                    
                    $icon   =  $ModelMedia->insertData($data_media)['response'];

                    $data_update   =   [

                        'updated_at'    =>  $updated_at,
                        'icon'          =>  $icon

                    ];

                    $where  =   [

                        [
                            'fields'    =>  'key',
                            'operator'  =>  '=',
                            'value'     => 'logo'

                        ]
                    ]; 
                    $ModelSetting->updateData($data_update,$where);
                }else{


                    $icon   =  $ModelMedia->insertData($data_media);

                    $data   =  [

                        'key'   =>  $key_logo,
                        'icon'  =>  $icon['response'],
                        'title' =>  'Logo',
                    ];

                    $data_insert    =    $ModelSetting->insertData($data); 

                }


            }


            // set data and condition
            $data_insert   =   [

                'created_at'    =>  $updated_at,
                
            ];

            $data_update   =   [

                'updated_at'    =>  $updated_at,

            ];

            $where  =   [

                [
                    'fields'    =>  'key',
                    'operator'  =>  '=',

                ]
            ];  

           //========================================================
            //
            //  INSERT OR UPDATE COMPANY NAME
            //
            //========================================================

            $key_company_name   =   Config::get('spr.type.setting.company-info.company_name.key');

            if(!empty($ModelSetting->checkKeyExist($key_company_name)['response'])){

                $data_update['title']   =   $company_name;
                $where[0]['value']      =   $key_company_name;
                $ModelSetting->updateData($data_update,$where);

            }else{

                $data_insert['title']   =   $company_name;
                $data_insert['key']     =   $key_company_name;
                $ModelSetting->insertData($data_insert);
            }



            //========================================================
            //
            //  INSERT OR UPDATE EMAIL SUPPORT CUSTOMER
            //
            //========================================================

            $key_email_support   =   Config::get('spr.type.setting.company-info.email_support.key');

            if(!empty($ModelSetting->checkKeyExist($key_email_support)['response'])){

                $data_update['title']   =   $email_support;
                $where[0]['value']      =   $key_email_support;
                $ModelSetting->updateData($data_update,$where);

            }else{

                $data_insert['title']   =   $email_support;
                $data_insert['key']     =   $key_email_support;
                $ModelSetting->insertData($data_insert);
            }   
              
            

            //========================================================
            //
            //  INSERT OR UPDATE HOTLINE SUPPORT CUSTOMER
            //
            //========================================================


            $key_hotline   =   Config::get('spr.type.setting.company-info.hotline.key');

            if(!empty($ModelSetting->checkKeyExist($key_hotline)['response'])){

                $data_update['title']   =   $hotline;
                $where[0]['value']      =   $key_hotline;
                $ModelSetting->updateData($data_update,$where);

            }else{

                $data_insert['title']   =   $hotline;
                $data_insert['key']     =   $key_hotline;
                $ModelSetting->insertData($data_insert);
            }


            //========================================================
            //
            //  INSERT OR UPDATE TOTAL PRODUCTS
            //
            //========================================================


            $key_total_products   =   Config::get('spr.type.setting.company-info.total_products.key');

            if(!empty($ModelSetting->checkKeyExist($key_total_products)['response'])){

                $data_update['title']   =   $total_products;
                $where[0]['value']      =   $key_total_products;
                $ModelSetting->updateData($data_update,$where);

            }else{

                $data_insert['title']   =   $total_products;
                $data_insert['key']     =   $key_total_products;
                $ModelSetting->insertData($data_insert);
            }


            //========================================================
            //
            //  INSERT OR UPDATE TOTAL TRANSACTION SUCCESS
            //
            //========================================================


            $key_total_transaction_success   =   Config::get('spr.type.setting.company-info.total_transaction_success.key');

            if(!empty($ModelSetting->checkKeyExist($key_total_transaction_success)['response'] != null)){

                $data_update['title']   =   $total_transaction_success;
                $where[0]['value']      =   $key_total_transaction_success;
                $ModelSetting->updateData($data_update,$where);

            }else{

                $data_insert['title']   =   $total_transaction_success;
                $data_insert['key']     =   $key_total_transaction_success;
                $ModelSetting->insertData($data_insert);
            }



            //========================================================
            //
            //  INSERT OR UPDATE SUB DESCRIPTION
            //
            //========================================================

            $key_sub_description   =   Config::get('spr.type.setting.company-info.sub_description.key');

            if(!empty($ModelSetting->checkKeyExist($key_sub_description)['response'])){

                $data_update['description']   =   $description;
                $where[0]['value']      =   $key_sub_description;
                $ModelSetting->updateData($data_update,$where);

            }else{

                $data_insert['title']           =   'MUA HÀNG AMAZON CHƯA BAO GIỜ DỄ THẾ';
                $data_insert['description']     =   $description;
                $data_insert['key']             =   $key_sub_description;
                $ModelSetting->insertData($data_insert);
            }

        }else{

        }

        return $data_output_validate_param;
        
    }

    public function updateData($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $id             =   $data_output_validate_param['response']['id'];
            $title          =   $data_output_validate_param['response']['title'];
            $description    =   $data_output_validate_param['response']['description'];
            $icon           =   $data_output_validate_param['response']['image'];
            $icon_class     =   $data_output_validate_param['response']['icon_class'];
            $media_id       =   $data_output_validate_param['response']['icon'];
            $updated_at     =   $data_output_validate_param['response']['updated_at'];

            $ModelSetting    =   new ModelSetting();
            $ModelMedia         =   new ModelMedia(); 
            $id_image           =   null;

            $where              =   [

                [
                    'fields'    =>  'id',
                    'operator'  =>  '=',
                    'value'     =>  $id,
                ]

            ];

            $data = [

                'title'         =>  $title,
                'description'   =>  $description,
                'icon_class'    =>  $icon_class,
                'updated_at'    =>  $updated_at,
            ];

            if($icon !=null && $icon != ''){

                $mime_type = Config::get('spr.type.mimeFile');

                $image_name =  HelperController::uniqid_base36($data_output_validate_param['response']['created_at']);

                $image_original_mime = $icon->getMimeType();

                $path_tmp = public_path( Config::get('spr.system.uploadMedia.path_tmp_upload') );
                $path     = public_path( Config::get('spr.system.uploadMedia.path_image_upload') );

                HelperController::create_path($path_tmp); 
                HelperController::create_path($path); 

                $full_path_file     = $path . '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];
                $full_path_file_tmp = $path_tmp . '/' . $image_name .'.'. Config::get('spr.type.mimeFile')[$image_original_mime];


                // save file tmp
                Image::make($icon)->save($full_path_file, 100);
                Image::make($icon)->save($full_path_file_tmp, 100);

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

                        $data_output_validate_param = $ModelSetting->updateData($data,$where);

                 }else{

                    $data_output_validate_param = $id_image;
                 }

            }else{

                $data_output_validate_param = $ModelSetting->updateData($data,$where);
            }    

        }else{

            $data_output_validate_param['response'] = array();
           
        }
         Session::flash('message', $data_output_validate_param['meta']['msg']);
        return $data_output_validate_param;
    }

    public function deleteData($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $ModelSetting     =  new ModelSetting();

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

            $data_output_validate_param = $ModelSetting->updateData($data,$where);

        }
        return $data_output_validate_param;
    }

    public function getAllData(){

        $results = Response::response();

        //$results['response']['company_info']                              =   $this->getDataFollowKey('company_info')['response'];
        $results['response']['commitment_of_company']                       =   $this->getDataFollowKey(Config::get('spr.type.setting.commitment-of-company.key'))['response'];
        $results['response']['services_of_company']                         =   $this->getDataFollowKey(Config::get('spr.type.setting.services-of-company.key'))['response'];
        $results['response']['why_choose_us']                               =   $this->getDataFollowKey(Config::get('spr.type.setting.why-choose-us.key'))['response'];
        $results['response']['logo']                                        =   $this->getLogo()['response'];
        $results['response']['company_name']                     =   $this->getCompanyInfo(Config::get('spr.type.setting.company-info.company_name.key'))['response'];
        $results['response']['email_support']                    =   $this->getCompanyInfo( Config::get('spr.type.setting.company-info.email_support.key'))['response'];
        $results['response']['hotline']                          =   $this->getCompanyInfo(Config::get('spr.type.setting.company-info.hotline.key'))['response'];
        $results['response']['total_products']                   =   $this->getCompanyInfo(Config::get('spr.type.setting.company-info.total_products.key'))['response'];
        $results['response']['total_transaction_success']        =   $this->getCompanyInfo(Config::get('spr.type.setting.company-info.total_transaction_success.key'))['response'];
        $results['response']['sub_description']                  =   $this->getCompanyInfo(Config::get('spr.type.setting.company-info.sub_description.key'))['response'];
        $results['response']['rules']                            =   $this->getCompanyInfo(Config::get('spr.type.setting.company-info.rules.key'))['response'];



        return $results;
    }

    public function getDataFollowKey($key){

        $results        = Response::response(); 
 
        $ModelSetting = new ModelSetting();

        $where = [
            [
                'fields'    =>  's.key',
                'operator'  =>  '=',
                'value'     =>  $key,
            ],
            [
                'fields'    =>  's.deleted_at',
                'operator'  =>  'null',
                'value'     =>  'NULL'
            ]
        ];

        $data = $ModelSetting->getData($where);

        if($data['meta']['success']){

            $results    =   $data;
        }

        return $results;

    }

    public function getLogo(){

        $ModelSetting   =   new ModelSetting();
        $results        =   $ModelSetting->getLogo();
        return $results;
    }

    public function getCompanyInfo($key){

        $ModelSetting   =   new ModelSetting();
        $results        =   $ModelSetting->getCompanyInfo($key);
        return $results;
    }

    public function updateRules($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $title          =   $data_output_validate_param['response']['title'];
            $description    =   $data_output_validate_param['response']['description'];
            $date           =   $data_output_validate_param['response']['created_at'];
            $where          =   [];
            $ModelSetting   =   new ModelSetting();

            $key_rules      =   Config::get('spr.type.setting.company-info.rules.key');
            $data           =   [

                'title'         =>  $title,
                'description'   =>  $description,
            ];

            if(!empty($ModelSetting->checkKeyExist($key_rules)['response'])){

                $data['updated_at']   =   $date;
                
                $where     =   [
                    [
                        'fields'    =>  'key',
                        'operator'  =>  '=',
                        'value'     =>  $key_rules,
                    ]    
                ];

                $ModelSetting->updateData($data,$where);

            }else{

                $data['created_at']      =   $date;
                $data['key']             =   $key_rules;

                $ModelSetting->insertData($data);
            }
        }
        return $data_output_validate_param;
    }

}    