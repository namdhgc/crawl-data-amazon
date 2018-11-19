<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\PriceList as ModelPriceList;
use App\Http\Models\PriceListDetail as ModelPriceListDetail;
use Spr\Base\Controllers\Helper as HelperController;
use Intervention\Image\Exception\NotReadableException;
use Input;
use Config;
use Auth;
use Lang;
use Session;

class PriceListController  extends Controller
{


    public function __construct()
    {

    }

    public function actionInsertOrUpdate($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

            $where          = [];
            $id             = $data_output_validate_param['response']['id'];
            $name           = $data_output_validate_param['response']['name'];
            $description    = $data_output_validate_param['response']['description'];
            $type           = $data_output_validate_param['response']['type'];
            $default_type   = Config::get('spr.type.type.price.default.value');
            $ModelPriceList = new ModelPriceList();


            $data = [
                'name'          => $name,
                'type'          => $type,
                'description'   => $description,
                'kind'          => '0'
            ];

            if($id == null || $id == '') {

                //insert
                $data['created_at'] = $data_output_validate_param['response']['created_at'];

                if ($type == $default_type) {
                    
                    if($ModelPriceList->checkTotalPriceListDefault()['response']->total > 0){
                        
                        $data_output_validate_param['meta']['success']          =   false;
                        $data_output_validate_param['meta']['msg']['status']    =   Lang::get('message.web.error.0027');

                        return $data_output_validate_param;
                    }
                }

                $data_output_validate_param['response']['data'] = $ModelPriceList->insertData($data)['response'];

                if($data_output_validate_param['meta']['success']){

                    $data_output_validate_param['meta']['msg']['status']    =   Lang::get('message.web.success.0002');

                }else{

                    $data_output_validate_param['meta']['success']          =   false;;
                    $data_output_validate_param['meta']['msg']['status']    =   Lang::get('message.web.error.0017');
                }

            }else {

                // update
                $where = [
                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $id
                    ]
                ];

                $data['updated_at']   = $data_output_validate_param['response']['created_at'];

                if ($type == $default_type) {
                    
                    if( $ModelPriceList->checkIsPriceListDefault($id)['response']->total == 0 && $ModelPriceList->checkTotalPriceListDefault()['response']->total > 0){

                        $data['meta']['success']                                = false;
                        $data_output_validate_param['meta']['success']          = false;
                        $data_output_validate_param['meta']['msg']['status']    = Lang::get('message.web.error.0027');
                         
                    } else {
                    
                        $data = $ModelPriceList->updateData($data, $where);
                    }
                } else{

                    $data = $ModelPriceList->updateData($data, $where);
                }

                if($data['meta']['success']){

                    $data_output_validate_param = $data;
                    $data_output_validate_param['meta']['msg']['status']    =   Lang::get('message.web.success.0001');

                }else{

                    $data_output_validate_param['meta']['success']          =   false;
                    $data_output_validate_param['meta']['msg']['status']    =   Lang::get('message.web.error.0018');

                }
            }
        }

        Session::flash('msg', $data_output_validate_param['meta']['msg']); 
        return $data_output_validate_param;
    }

    public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {

            $ModelPriceList = new ModelPriceList();

            $data = $ModelPriceList->getDataManage($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response'] = array();
            $data_output_validate_param['response']['data'] = [];
        }

        return $data_output_validate_param['response'];
    }


    public function changeStatusPriceList($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){


            $id         = $data_output_validate_param['response']['id'];
            $type       = $data_output_validate_param['response']['type'];
            $updated_at = $data_output_validate_param['response']['updated_at'];

            $ModelPriceList = new ModelPriceList();
            $where  =   [];

            if($ModelPriceList->checkIdExist($id)['response']->total > 0){
                $where  =   [

                    [

                        'fields'    =>  'id',
                        'operator'  =>  '=',
                        'value'     =>  $id,    
                    ]
                ];

                if($type == 0 && $ModelPriceList->checkIsPriceListDefault($id)['response']->total > 0){

                    $type = 1;

                }else{

                    $type = 0;

                }

                $data   =   [

                        'type'          =>  $type,
                        'updated_at'    =>  $updated_at
                ];

                if($type == 0 && $ModelPriceList->checkIsPriceListDefault($id)['response']->total == 0 
                    && $ModelPriceList->checkTotalPriceListDefault()['response']->total > 0)
                {
                    $data_output_validate_param['meta']['success']  = false;
                    $data_output_validate_param['meta']['msg']['status']      =   Lang::get('message.web.error.0027');   

                }else{

                    $result     =   $ModelPriceList->updateData($data,$where);

                    if($result['meta']['success']){

                            $data_output_validate_param['meta']['msg']['status']    =   Lang::get('message.web.success.0001');
                             $data_output_validate_param['response']['type']      =   $type;

                    }else{

                            $data_output_validate_param['meta']['success']          =   false;
                            $data_output_validate_param['meta']['msg']['status']    =   Lang::get('message.web.error.0018');
                    }
                }  
            }
        }
        
        return $data_output_validate_param;

    }

    public function deleteData($data_output_validate_param){

        $id             =   $data_output_validate_param['response']['id'];
        $type           =   $data_output_validate_param['response']['type'];
        $deleted_at     =   $data_output_validate_param['response']['created_at'];

        $ModelPriceList             = new ModelPriceList();
        $ModelPriceListDetail       = new ModelPriceListDetail();


        if($data_output_validate_param['meta']['success']){

            if ($type != 0) {
                
                $where = [
                    [
                        'fields'    =>  'id',
                        'operator'  =>  '=',
                        'value'     =>  $id
                    ]
                ];

                $where_detail = [
                    [
                        'fields'    =>  'price_id',
                        'operator'  =>  '=',
                        'value'     =>  $id
                    ]
                ];

                $data = [   

                    'deleted_at'    =>  $deleted_at

                ];

                $data_output_validate_param = $ModelPriceListDetail->updateData($data,$where_detail);


                if($data_output_validate_param['meta']['success']){

                    $data_output_validate_param = $ModelPriceList->updateData($data,$where);
                    $data_output_validate_param['meta']['msg']['status']    =   Lang::get('message.web.success.0004');

                }
            } else {

                $data_output_validate_param['meta']['success']          =   false;
                $data_output_validate_param['meta']['msg']['status']    =   Lang::get('message.web.error.0035');
            }
        }

        return $data_output_validate_param;

    }
}
?>