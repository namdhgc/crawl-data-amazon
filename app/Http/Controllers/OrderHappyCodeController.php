<?php

namespace App\Http\Controllers;

use App\Http\Models\OrderHappyCode as ModelOrderHappyCode;
use Config;
use Input;
use Auth;
use Lang;

/**
*
*/
class OrderHappyCodeController extends Controller
{

    protected $table                = 'happy_code_order';
	protected $length_happy_code    = 10;

	function __construct()
	{
		# code...
	}

    public function insertData($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $where              = [];
            $payment_type       = $data_output_validate_param['response']['payment_type'];
            $happy_code_type    = $data_output_validate_param['response']['happy_code_type'];
            $buyer_id           = Auth::guard('customer')->user()->id;
            // $happy_code         = bin2hex(random_bytes($this->length_happy_code));

            // $where_happy_code = [
            //     [
            //         'fields'    => 'code',
            //         'operator'  => '=',
            //         'value'     => $happy_code
            //     ]
            // ];

            // $ModelOrderHappyCode    = new ModelOrderHappyCode();
            // $check                  = $ModelOrderHappyCode->checkExistshappyCode($where_happy_code);

            // if ($check['response'] === null) {

                // not exists record
                $data = [
                    'payment_type'      => $payment_type,
                    'happy_code_type'   => $happy_code_type,
                    // 'code'              => $happy_code,
                    'buyer_id'          => $buyer_id,
                    'created_at'        => strtotime(\Carbon\Carbon::now()->toDateTimeString()),
                ];

                $results = ModelOrderHappyCode::insertData($this->table, $data, $where);

                $data_output_validate_param['meta']['code'] = 200;
                $data_output_validate_param['meta']['msg']  = ['Registered successful'];
            // } else {

            //     $results = $this->insertData($data_output_validate_param);
            // }
        }

        return $data_output_validate_param;
    }

    public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];

        if (isset($key_search)) {

            $key_search     = $data_output_validate_param['response']['key_search'];
        } else {

            $key_search     = '';
        }

        if ($data_output_validate_param['meta']['success']) {

            $where = [
                // [
                //     'operator' => 'raw',
                //     'sql' =>  "(
                //         first_name like '%".$key_search."%'

                //         OR

                //         last_name like '%".$key_search."%'

                //         OR

                //         email like '%".$key_search."%'

                //         OR

                //         code like '%".$key_search."%'
                //     )" 
                // ]
            ];

            $order = [
                [
                    'fields'    => $sort,
                    'operator'  => $sort_type
                ]
            ];

            $results = ModelOrderHappyCode::selectData($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order );

            return array('data' => $results, 'sort' => $sort, 'limit' => $limit , 'sort_type' => $sort_type, 'key_search' => $key_search);
        } else {

            // return $data_output_validate_param['meta']['success'];
            $data_output_validate_param['response'] = array();

            return array('data' => $data_output_validate_param, 'sort' => $sort, 'limit' => $limit , 'sort_type' => $sort_type, 'key_search' => $key_search);
        }
    }


    public function getDataManage($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $sort           = $data_output_validate_param['response']['sort'];
            $limit          = $data_output_validate_param['response']['limit'];
            $sort_type      = $data_output_validate_param['response']['sort_type'];
            $key_search     = $data_output_validate_param['response']['key_search'];

            $where  = [
                // [
                //     'fields'    => 'u.email',
                //     'operator'  => 'like',
                //     'value'     => '%'. $key_search . '%'
                // ]
            ];

            $order  = [
                [
                    'fields'    => $sort,
                    'operator'  => $sort_type
                ]
            ];

            $ModelOrderHappyCode    = new ModelOrderHappyCode();
            $results                = $ModelOrderHappyCode->getDataManage($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order );

            return array('data' => $results, 'sort' => $sort, 'limit' => $limit , 'sort_type' => $sort_type, 'key_search' => $key_search);
        } else {

            $data_output_validate_param['response'] = array();

            return array('data' => $data_output_validate_param, 'sort' => $sort, 'limit' => $limit , 'sort_type' => $sort_type, 'key_search' => $key_search);
        }
    }



    public function updateHappyCodeOrder($data_output_validate_param) {


// dd($data_output_validate_param);
        if ($data_output_validate_param['meta']['success']) {

            $happy_code_order_id    = $data_output_validate_param['response']['happy_code_order_id'];
            $happy_code_type        = $data_output_validate_param['response']['happy_code_type'];
            $amount                 = $data_output_validate_param['response']['amount'];
            $status                 = $data_output_validate_param['response']['status'];
            $status_inactive        = '0';
            $status_active          = '1';

            $happy_code_price   = Config::get('spr.system.happy_code_type.' . $happy_code_type . '.price');
            $time_now           = strtotime(\Carbon\Carbon::now()->toDateTimeString());

            if ($amount != $happy_code_price) {

                // no update
                $data_output_validate_param['meta']['success']  = false;
                $data_output_validate_param['meta']['code']     = 500;
                $data_output_validate_param['meta']['msg']      = [ Lang::get('message.web.error.0036') ];

                return $data_output_validate_param;
            } else {

                if ($status == $status_active) {
                    
                    // generate happy code and update
                    // $happy_code         = bin2hex(random_bytes($this->length_happy_code));
                    $happy_code = "OH-" . strtoupper(bin2hex(random_bytes(4))).'-'. substr($time_now, 4, 7);

                    $where_happy_code = [
                        [
                            'fields'    => 'code',
                            'operator'  => '=',
                            'value'     => $happy_code
                        ]
                    ];

                    $ModelOrderHappyCode    = new ModelOrderHappyCode();
                    $check                  = $ModelOrderHappyCode->checkExistshappyCode($where_happy_code);

                    if ($check['response'] === null) {

                        $data = [
                            'code'              => $happy_code,
                            'status'            => $status_active,
                            'price'             => $amount,
                            'effective_at'      => $time_now,
                            'updated_at'        => $time_now,
                        ];

                        $where = [
                            [
                                'fields'    => 'id',
                                'operator'  => '=',
                                'value'     => $happy_code_order_id
                            ]
                        ];

                        $results = $ModelOrderHappyCode->updateData($this->table, $data, $where);
                        $data_output_validate_param['meta']['msg']  = [ Lang::get('message.web.success.0009') ];


                        // send mail
                    } else {

                        $results = $this->updateHappyCodeOrder($data_output_validate_param);
                    }
                } else {

                    $data_output_validate_param['meta']['msg']  = [ Lang::get('message.web.warning.0001') ];
                }
                
            }
        }

        return $data_output_validate_param;
    }
}