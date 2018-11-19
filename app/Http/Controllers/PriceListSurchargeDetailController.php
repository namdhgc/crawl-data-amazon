<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\PriceListDetail as ModelPriceListSurchargeDetail;
use Spr\Base\Controllers\Helper as HelperController;
use Intervention\Image\Exception\NotReadableException;
use Input;
use Config;
use Auth;
use Lang;
use Session;

class PriceListSurchargeDetailController  extends Controller
{


    public function __construct()
    {
    }


    public function insertData($data_output_validate_param){

        if ($data_output_validate_param['meta']['success']) {
            $id             = $data_output_validate_param['response']['id'];
            $price_id       = $data_output_validate_param['response']['price_id'];
            $key            = $data_output_validate_param['response']['key'];
            $value          = $data_output_validate_param['response']['value'];
            $created_at     = $data_output_validate_param['response']['created_at'];

            $data           =[
                'price_id'  =>  $price_id,
                'key'       =>  $key,
                'value'     =>  $value,
                'created_at'=>  $created_at,
            ];

            $ModelPriceListSurchargeDetail = new ModelPriceListSurchargeDetail();

            $id    = $ModelPriceListSurchargeDetail->insertData($data)['response'];

            $data_output_validate_param['response']['id'] = $id;
            $data_output_validate_param['meta']['msg'] =['Insert success !'];
        }
        return $data_output_validate_param;
    }

    public function updateData($data_output_validate_param) {

         if ($data_output_validate_param['meta']['success']) {

            $where          = [];
            $id             = $data_output_validate_param['response']['id'];
            $key            = $data_output_validate_param['response']['key'];
            $value          = $data_output_validate_param['response']['value'];
            $updated_at     = $data_output_validate_param['response']['created_at'];

            $data           =[
                'key'       =>  $key,
                'value'     =>  $value,
                'updated_at'=>  $updated_at,
            ];
            $tmp = [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id
                ];
            array_push($where, $tmp);
            $ModelPriceListSurchargeDetail = new ModelPriceListSurchargeDetail();
            $data_output_validate_param = $ModelPriceListSurchargeDetail->updateData($data, $where);
            $data_output_validate_param['meta']['msg'] ='Update success !';

        }
        return $data_output_validate_param;
    }

    public function deleteData($data_output_validate_param){
        if ($data_output_validate_param['meta']['success']) {

            $where          = [];
            $id             = $data_output_validate_param['response']['id'];
            $deleted_at     = $data_output_validate_param['response']['created_at'];

            $data           =   [

                'deleted_at'    =>  $deleted_at
            ];

            $tmp    =   [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id
                ];
            array_push($where, $tmp);
            $ModelPriceListSurchargeDetail = new ModelPriceListSurchargeDetail();
            $data_output_validate_param = $ModelPriceListSurchargeDetail->updateData($dadta,$where);
            $data_output_validate_param['meta']['msg'] ='Delete success !';

        }
        return $data_output_validate_param;
    }
    public function getData($data_output_validate_param) {

            if ($data_output_validate_param['meta']['success'])
            {

                $price_id = $data_output_validate_param['response']['id'];

                $ModelPriceListSurchargeDetail = new ModelPriceListSurchargeDetail();
                $results = $ModelPriceListSurchargeDetail->selectData($price_id);
                return $results;
            } else {

                return $data_output_validate_param['meta']['success'];
            }
        }
    }
?>