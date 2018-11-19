<?php

namespace App\Http\Controllers;

use App\Http\Models\PaymentTypeDetail as ModelPaymentTypeDetail;
use Spr\Base\Response\Response;
use Session;
use Input;

/**
*
*/
class PaymentTypeDetailController extends Controller
{

	protected $table = "payment_type_detail";

	function __construct()
	{
		# code...
	}


	public function getData($data_output_validate_param) {

		if ($data_output_validate_param['meta']['success']) {

			$limit 				= $data_output_validate_param['response']['limit'];
			$sort 				= $data_output_validate_param['response']['sort'];
			$sort_type 			= $data_output_validate_param['response']['sort_type'];
			$key_search 		= $data_output_validate_param['response']['key_search'];
			$payment_type_id 	= $data_output_validate_param['response']['payment_type_id'];

			$ModelPaymentTypeDetail = new ModelPaymentTypeDetail();

			$results = $ModelPaymentTypeDetail->getDataManage($key_search, $limit, $sort, $sort_type, $payment_type_id);

			$data_output_validate_param['response']['data'] = $results;
		}

		return $data_output_validate_param['response'];
	}

	public function deleteData($data_output_validate_param){

        $id =   $data_output_validate_param['response']['id'];

		$ModelPaymentTypeDetail = new ModelPaymentTypeDetail();



        if($data_output_validate_param['meta']['success']){

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

            $data_output_validate_param['response']['data'] = $ModelPaymentTypeDetail->updateData($this->table, $data,$where);
            $data_output_validate_param['meta']['msg'] 		= ['Deleted successfully.'];
        }

        return $data_output_validate_param['response'];
    }

    public function insertOrUpdate($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']){

            $id 				= $data_output_validate_param['response']['id'];
            $title 				= $data_output_validate_param['response']['title'];
            $description 		= $data_output_validate_param['response']['description'];
            $payment_value 		= $data_output_validate_param['response']['payment_value'];
            $type   			= $data_output_validate_param['response']['type'];
            $cost_incurred 		= $data_output_validate_param['response']['cost_incurred'];
            $specified_value   	= $data_output_validate_param['response']['specified_value'];
            $bonus   			= $data_output_validate_param['response']['bonus'];
            $payment_type_id   	= $data_output_validate_param['response']['payment_type_id'];

            $where 					= [];
			$ModelPaymentTypeDetail = new ModelPaymentTypeDetail();

			if ($bonus == '')            $bonus = null;
            if ($cost_incurred == '')    $cost_incurred = null;
            if ($specified_value == '')  $specified_value = null;

			$data = [
				'title' 			=> $title,
                'description' 		=> $description,
                'payment_value' 	=> $payment_value,
                'type' 				=> $type,
                'cost_incurred' 	=> $cost_incurred,
                'specified_value'   => $specified_value,
                'bonus' 			=> $bonus,
                'payment_type_id' 	=> $payment_type_id,
			];

            if($id != null && $id != ""){

                $where  =   [
                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $id
                    ]
                ];

                $data['updated_at'] 		= strtotime(\Carbon\Carbon::now()->toDateTimeString());
                $data_output_validate_param = $ModelPaymentTypeDetail->updateData($this->table, $data,$where);

            }else{

                $data['created_at'] 		= strtotime(\Carbon\Carbon::now()->toDateTimeString());
                $data_output_validate_param = $ModelPaymentTypeDetail->insertData($this->table, $data,$where);
            }
            Session::flash('message','');

        }else{

            Session::flash('message', $data_output_validate_param['meta']['msg']);
        }

        return $data_output_validate_param;
    }

}