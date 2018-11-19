<?php

namespace App\Http\Controllers;

use Input;
use App\Http\Models\PaymentType as ModelPaymentType;
use Spr\Base\Response\Response;
use Session;

/**
*
*/
class PaymentTypeController extends Controller
{

	protected $table = "payment_type";

	function __construct()
	{
		# code...
	}


	public function getData($data_output_validate_param) {

		if ($data_output_validate_param['meta']['success']) {

			$limit 		= $data_output_validate_param['response']['limit'];
			$sort 		= $data_output_validate_param['response']['sort'];
			$sort_type 	= $data_output_validate_param['response']['sort_type'];
			$key_search = $data_output_validate_param['response']['key_search'];

			$ModelPaymentType = new ModelPaymentType();

			$results = $ModelPaymentType->getDataManage($key_search, $limit, $sort, $sort_type);

			$data_output_validate_param['response']['data'] = $results;
		}

		return $data_output_validate_param['response'];
	}

	public function deleteData($data_output_validate_param){

        $id             = $data_output_validate_param['response']['id'];
        $default_type   = 0;

		$ModelPaymentType = new ModelPaymentType();

        $check = $ModelPaymentType->checkExistsRecord($id, $default_type);

        if($data_output_validate_param['meta']['success']){

            if ($check['response'] == null) {

                // this is not default type, so we can delete it
                $where = [
                    [
                        'fields'    =>  'id',
                        'operator'  =>  '=',
                        'value'     =>  $id
                    ]
                ];

                $data = [
                    'deleted_at'    =>  strtotime(\Carbon\Carbon::now()->toDateTimeString())
                ];

                $data_output_validate_param['response']['data'] = $ModelPaymentType->updateData($this->table, $data,$where);
                $data_output_validate_param['meta']['msg']      = ['Deleted successfully.'];
            } else {

                $data_output_validate_param['meta']['success']  = false;
                $data_output_validate_param['meta']['code']     = 501;
                $data_output_validate_param['meta']['msg']      = ['' => 'This is default record, can not delete it!'];

                Session::flash('message', $data_output_validate_param['meta']['msg']);

            }
        }

        return $data_output_validate_param;
    }

    public function insertOrUpdate($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']){

            $id 	= $data_output_validate_param['response']['id'];
            $name   = $data_output_validate_param['response']['name'];
            $type   = $data_output_validate_param['response']['type'];
            $where 	= [];
			$ModelPaymentType = new ModelPaymentType();

          	if ($type == null || $type == '') {

          		$type = 2;
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
                    'name' 			=> $name,
                    'type'       	=> $type,
                    'updated_at' 	=> strtotime(\Carbon\Carbon::now()->toDateTimeString())
                ];

                $data_output_validate_param = $ModelPaymentType->updateData($this->table, $data,$where);

            }else{

                $data   =   [
                    'name' 			=> $name,
                    'type'       	=> $type,
                    'created_at'  	=> strtotime(\Carbon\Carbon::now()->toDateTimeString())
                ];

                $data_output_validate_param = $ModelPaymentType->insertData($this->table, $data,$where);
            }
            Session::flash('message','');

        }else{

            Session::flash('message', $data_output_validate_param['meta']['msg']);
        }

        return $data_output_validate_param;

    }

}