<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\PriceListSurcharge as ModelPriceListSurcharge;
use App\Http\Models\PriceListDetail as ModelPriceListSurchargeDetail;
use Spr\Base\Controllers\Helper as HelperController;
use Intervention\Image\Exception\NotReadableException;
use Input;
use Config;
use Auth;
use Lang;
use Session;

class PriceListSurchargeController  extends Controller
{


    public function __construct()
    {
    }

    public function actionInsertOrUpdate($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $where              = [];
            $id                 = $data_output_validate_param['response']['id'];
            $name               = $data_output_validate_param['response']['name'];
            $description        = $data_output_validate_param['response']['description'];
            $type_surcharge     = $data_output_validate_param['response']['type_surcharge'];
            
            $data = [
                'name'              => $name,
                'type_surcharge'    => $type_surcharge,
                'description'       => $description,
                'kind'              => '1',
            ];

            if ($id == null || $id == '') {

                $ModelPriceListSurcharge = new ModelPriceListSurcharge();
                $data['created_at']   = $data_output_validate_param['response']['created_at'];
                $id    = $ModelPriceListSurcharge->insertData($data)['response'];
                $data_output_validate_param['response']['id'] = $id;

            } else {

                $tmp = [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id
                ];

                array_push($where, $tmp);
                $data['updated_at']   = $data_output_validate_param['response']['created_at'];
                $ModelPriceListSurcharge = new ModelPriceListSurcharge();
                $data_output_validate_param = $ModelPriceListSurcharge->updateData($data, $where);
            }
        }

        return $data_output_validate_param;
    }

    public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {

            $ModelPriceListSurcharge = new ModelPriceListSurcharge();

            $data = $ModelPriceListSurcharge->getDataManage($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response'] = array();
            $data_output_validate_param['response']['data'] = [];
        }

        return $data_output_validate_param['response'];
    }

    public function deleteData($data_output_validate_param){

        $id             =   $data_output_validate_param['response']['id'];
        $deleted_at     =   $data_output_validate_param['response']['created_at'];

        $ModelPriceListSurcharge             = new ModelPriceListSurcharge();
        $ModelPriceListSurchargeDetail       =   new ModelPriceListSurchargeDetail();


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
                    'fields'    =>  'price_id',
                    'operator'  =>  '=',
                    'value'     =>  $id
                ]
            ];


            $data = [   

                'deleted_at'    =>  $deleted_at

            ];

            $data_output_validate_param = $ModelPriceListSurchargeDetail->updateData($data,$where_detail);


            if($data_output_validate_param['meta']['success']){

                $data_output_validate_param = $ModelPriceListSurcharge->updateData($data,$where);
            }
            
        }

        return $data_output_validate_param;

    }
}
?>