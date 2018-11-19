<?php

namespace App\Http\Controllers;

use App\Http\Models\PriceHappyCode as ModelPriceHappyCode;
use Config;
use Input;
use Auth;
use Cache;


/**
* 
*/
class PriceHappyCodeController extends Controller
{

    protected $table                = 'price_happy_code';
	
	function __construct()
	{
		# code...
	}

    public function insertUpdateData($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $id             = $data_output_validate_param['response']['id'];
            $title          = $data_output_validate_param['response']['title'];
            $discount       = $data_output_validate_param['response']['discount'];
            $expired_day    = $data_output_validate_param['response']['expired_day'];
            $price          = $data_output_validate_param['response']['price'];
            $where          = [];
            
            $ModelPriceHappyCode = new ModelPriceHappyCode();

            if (isset($id) && $id != '') {
                
                //update
                $where = [
                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $id
                    ]
                ];

                $data = [
                    'title'         => $title,
                    'discount'      => $discount,
                    'expired_day'   => $expired_day,
                    'price'         => $price,
                    'updated_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString()),
                ];

                $results = ModelPriceHappyCode::updateData($this->table, $data, $where);

                $data_output_validate_param['meta']['code'] = 200;
                $data_output_validate_param['meta']['msg']  = ['Updated successful'];

            } else {

                //insert
                $where = [];

                // not exists record
                $data = [
                    'title'         => $title,
                    'discount'      => $discount,
                    'expired_day'   => $expired_day,
                    'price'         => $price,
                    'created_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString()),
                ];

                $results = ModelPriceHappyCode::insertData($this->table, $data, $where);

                $data_output_validate_param['meta']['code'] = 200;
                $data_output_validate_param['meta']['msg']  = ['Registered successful'];
                
            }
        }

        return $data_output_validate_param;
    }

    public function deleteData($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $id           = $data_output_validate_param['response']['id'];

            $where = [
                [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id
                ]
            ];

            $data['deleted_at'] = strtotime(\Carbon\Carbon::now()->toDateTimeString());

            $results = ModelPriceHappyCode::updateData($this->table, $data, $where);

            $data_output_validate_param['meta']['code'] = 200;
            $data_output_validate_param['meta']['msg']  = ['Deleted successful'];
        } else {

            $data_output_validate_param['meta']['code'] = 500;
            $data_output_validate_param['meta']['msg']  = ['Deleted fail.'];

        }

        return $data_output_validate_param;
    }

    public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if ($data_output_validate_param['meta']['success']) {

            $where = [
                [
                    'fields'    => 'deleted_at',
                    'operator'  => 'null',
                ],
                [
                    'fields'    => 'title',
                    'operator'  => 'like',
                    'value'     => '%'. $key_search . '%',
                ],
            ];

            $order = [
                [
                    'fields'    => $sort,
                    'operator'  => $sort_type
                ]
            ];

            $results = ModelPriceHappyCode::selectData($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order );

            return array('data' => $results, 'sort' => $sort, 'limit' => $limit , 'sort_type' => $sort_type,  'key_search' => $key_search);
        } else {

            // return $data_output_validate_param['meta']['success'];
            $data_output_validate_param['response'] = array();

            return array('data' => $data_output_validate_param, 'sort' => $sort, 'limit' => $limit , 'sort_type' => $sort_type,  'key_search' => $key_search);
        }
    }

}