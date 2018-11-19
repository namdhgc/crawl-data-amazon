<?php

namespace App\Http\Controllers;

use App\Http\Models\PriceRequest;
use Config;
use Input;
use Lang;
use Auth;


/**
*
*/
class PriceRequestController extends Controller
{

	protected $table = 'price_request';

	function __construct()
	{
		# code...
	}

	public function insertData($data_output_validate_param) {

        // dd(Input::all());
        // dd($data_output_validate_param);

        if ($data_output_validate_param['meta']['success']) {

            $where      = [];
            $link       = "";
            $split_char = "|";

            $temp_link      = Input::get('link');
            $message        = Input::get('message');
            $fullName       = Input::get('fullName');
            $phone          = Input::get('phone');
            $email          = Input::get('email');
            $captcha        = Input::get('g-recaptcha-response');
            $secret_key     = '6LccdiUUAAAAAE0n2pSzf4gH74s8GfPbObb7IjzV';

            $link = implode($split_char, $temp_link);

            $data = [
                'link'          => $link,
                'message'       => $message,
                'fullName'      => $fullName,
                'phone'         => $phone,
                'email'         => $email,
                'created_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString()),
            ];

            $results = PriceRequest::insertData($this->table, $data, $where);

            $data_output_validate_param['meta']['code'] = 200;
            $data_output_validate_param['meta']['msg']  = [Lang::get('message.web.success.0003')];

        }

        return $data_output_validate_param;
    }

    public function getData($data_output_validate_param) {

        $id             = $data_output_validate_param['response']['id'];
        $customer_id    = $data_output_validate_param['response']['customer_id'];
        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if ($data_output_validate_param['meta']['success']) {

            $where = [];

            $order = [
                [
                    'fields'    => $sort,
                    'operator'  => $sort_type
                ]
            ];

            if (isset($id) && $id != null && $id != '') {

                $processor_id   = Auth::guard('web')->user()->id;

                $where = [
                    [
                        'fields'    => 'status',
                        'operator'  => '=',
                        'value'     => '1'
                    ],
                    [
                        'fields'    => 'processor_id',
                        'operator'  => '=',
                        'value'     => $processor_id
                    ],
                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $id
                    ]

                ];

                // return $results = PriceRequest::selectData($this->table, $where);
            }

            if (isset($customer_id) && $customer_id != null && $customer_id != '') {

                $where = [
                    [
                        'fields'    => 'customer_id',
                        'operator'  => '=',
                        'value'     => $customer_id
                    ]
                ];
            }

            $arr_key_search = [

                'operator' => 'raw',
                'sql' =>  "(

                    message like '%".$key_search."%'

                    OR 

                    email like '%".$key_search."%'

                    OR

                    phone like '%".$key_search."%'

                    OR

                    fullName like '%".$key_search."%'

                )" 
            ];

            array_push($where, $arr_key_search);

            $results = PriceRequest::selectData($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order );

            return array('data'             => $results, 
                            'sort'          => $sort, 
                            'limit'         => $limit, 
                            'sort_type'     => $sort_type, 
                            'key_search'    => $key_search
                        );

        } else {

            // return $data_output_validate_param['meta']['success'];
            $data_output_validate_param['response'] = array();

            return array('data'             => $data_output_validate_param,
                            'sort'          => $sort, 
                            'limit'         => $limit , 
                            'sort_type'     => $sort_type, 
                            'key_search'    => $key_search
                        );
        }
    }

    public function getTakenRequest($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];

        if ($data_output_validate_param['meta']['success']) {

            $processor_id   = Auth::guard('web')->user()->id;

            $where = [
                [
                    'fields'    => 'status',
                    'operator'  => '=',
                    'value'     => '1'
                ],
                [
                    'fields'    => 'processor_id',
                    'operator'  => '=',
                    'value'     => $processor_id
                ]
            ];

            $order = [
                [
                    'fields'    => $sort,
                    'operator'  => $sort_type
                ]
            ];

            $results = PriceRequest::selectData($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order );

            return array('data' => $results, 'sort' => $sort, 'limit' => $limit , 'sort_type' => $sort_type);
        } else {

            // return $data_output_validate_param['meta']['success'];
            $data_output_validate_param['response'] = array();

            return array('data' => $data_output_validate_param, 'sort' => $sort, 'limit' => $limit , 'sort_type' => $sort_type);
        }
    }

    public function updateStatus($data_output_validate_param) {

        // dd($data_output_validate_param);

        if ($data_output_validate_param['meta']['success']) {
            
            $id             = $data_output_validate_param['response']['id'];
            $status         = $data_output_validate_param['response']['status'];
            $processor_id   = Auth::guard('web')->user()->id;

            if ($data_output_validate_param['meta']['success']) {

                $where = [
                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $id
                    ]
                ];

                $data = [
                    'status'        => $status,
                    'processor_id'  => $processor_id,
                    'updated_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString()),
                ];

                $results = PriceRequest::updateData($this->table, $data, $where);

                $data_output_validate_param['meta']['code'] = 200;
                $data_output_validate_param['meta']['msg']  = [ Lang::get('message.web.success.0001') ];
            }
        }

        return $data_output_validate_param;

    }

    public function checkExistsRecord($data_output_validate_param) {

        $id = $data_output_validate_param['response']['id'];

        if ($data_output_validate_param['meta']['success']) {

            $status = PriceRequest::selectStatus($id);

            if ($status != null) {
                // exists record with status = 0

                $data_output_validate_param['meta']['code'] = 200;
                $data_output_validate_param['meta']['msg']  = [Lang::get('message.api.error.0001')];
            } else {

                $data_output_validate_param['meta']['code'] = 666;
                $data_output_validate_param['meta']['msg']  = [Lang::get('message.api.success.0001')];
            }
        }

        return $data_output_validate_param;
    }

    public function getPriceRequestPending($data_output_validate_param){
        if($data_output_validate_param['meta']['success']){

            $ModalPriceRequest              =   new PriceRequest();

            $results                        =   $ModalPriceRequest->getPending();

            $data_output_validate_param['response']['data']     =    $results['response'];

        }
        return $data_output_validate_param;
    }
}