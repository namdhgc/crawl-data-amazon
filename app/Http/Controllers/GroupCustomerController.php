<?php

namespace App\Http\Controllers;

use Auth;
use Lang;
use Input;
use Config;
use App\Http\Models\GroupCustomer as ModelGroupCustomer;
use Spr\Base\Response\Response;


/**
*
*/
class GroupCustomerController extends Controller
{

	protected $table = "group_customer";

	function __construct()
	{
		# code...
	}

	public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {

            $ModelGroupCustomer = new ModelGroupCustomer();

            $data = $ModelGroupCustomer->getDataManage($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response']['data'] = array();
        }

        return $data_output_validate_param['response'];
    }

    public function insertOrUpdate($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

            $id                 = $data_output_validate_param['response']['id'];
            $name               = $data_output_validate_param['response']['name'];
            $price_list_id      = $data_output_validate_param['response']['price_list_id'];
            $payment_type_id    = $data_output_validate_param['response']['payment_type_id'];

            $where  = [];
            $data   = [
                'name'              => $name,
                'price_list_id'     => $price_list_id,
                'payment_type_id'   => $payment_type_id,
            ];

            $ModelGroupCustomer = new ModelGroupCustomer();

            if ($id != null && $id != '') {

                // update

                $where = [
                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $id
                    ]
                ];

                $data['updated_at'] = strtotime(\Carbon\Carbon::now()->toDateTimeString());

                $results            = $ModelGroupCustomer->updateData($data, $where);

            } else {

                // insert
                $data['created_at'] = strtotime(\Carbon\Carbon::now()->toDateTimeString());

                $results            = $ModelGroupCustomer->insertData($data);
            }

            $data_output_validate_param['response']['data'] = $results;
            $data_output_validate_param['meta']['msg']      = [ Lang::get('message.web.success.0003') ];
        } else {

            $data_output_validate_param['meta']['code'] = 400;
            $data_output_validate_param['meta']['msg']  = [];
        }

        return $data_output_validate_param;
    }

    public function deleteData($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

            $id                 = $data_output_validate_param['response']['id'];
            $ModelGroupCustomer = new ModelGroupCustomer();

            $where = [
                [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id
                ]
            ];

            $data = [
                'deleted_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString())
            ];

            $results = $ModelGroupCustomer->updateData($data, $where);

            $data_output_validate_param['response']['data'] = $results;
            $data_output_validate_param['meta']['msg']      = [ Lang::get('message.web.success.0003') ];

        } else {

            $data_output_validate_param['meta']['code'] = 400;
            $data_output_validate_param['meta']['msg']  = [ Lang::get('message.web.error.0019') ];
        }

        return $data_output_validate_param;
    }

    
}