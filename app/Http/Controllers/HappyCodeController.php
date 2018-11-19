<?php

namespace App\Http\Controllers;

use App\Http\Models\HappyCode as ModelHappyCode;
use Config;
use Input;
use Auth;
use Cache;


/**
* 
*/
class HappyCodeController extends Controller
{

    protected $table                = 'happy_code';
	protected $length_happy_code    = 10;
	
	function __construct()
	{
		# code...
	}

    public function insertUpdateData($data_output_validate_param) {

        // dd($data_output_validate_param);

        if ($data_output_validate_param['meta']['success']) {

            $id         = $data_output_validate_param['response']['id'];
            $type       = $data_output_validate_param['response']['type'];
            $discount   = $data_output_validate_param['response']['discount'];
            $status     = $data_output_validate_param['response']['status'];
            $name       = $data_output_validate_param['response']['name'];
            $where      = [];
            
            $ModelHappyCode = new ModelHappyCode();

            if (isset($id) && $id != '') {
                
                //update
                $where = [
                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $id
                    ],
                    [
                        'fields'    => 'name',
                        'operator'  => 'like',
                        'value'     => '%' . $key_search . '%'
                    ]
                ];

                $data = [
                    'type'          => $type,
                    'discount'      => $discount,
                    'name'          => $name,
                    'status'        => $status,
                    'updated_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString()),
                ];

                $results = ModelHappyCode::updateData($this->table, $data, $where);

                $data_output_validate_param['meta']['code'] = 200;
                $data_output_validate_param['meta']['msg']  = ['Updated successful'];

            } else {

                //insert
                $where = [];

                // not exists record
                $data = [
                    'type'          => $type,
                    'discount'      => $discount,
                    'name'          => $name,
                    'status'        => $status,
                    'created_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString()),
                ];

                $results = ModelHappyCode::insertData($this->table, $data, $where);

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

            $results = ModelHappyCode::updateData($this->table, $data, $where);

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
                    'fields'    => 'name',
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

            $results = ModelHappyCode::selectData($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order );

            return array('data' => $results, 'sort' => $sort, 'limit' => $limit , 'sort_type' => $sort_type,  'key_search' => $key_search);
        } else {

            // return $data_output_validate_param['meta']['success'];
            $data_output_validate_param['response'] = array();

            return array('data' => $data_output_validate_param, 'sort' => $sort, 'limit' => $limit , 'sort_type' => $sort_type,  'key_search' => $key_search);
        }
    }

    public function addHappyCodeToShoppingCart ($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']){

            if( isset($_COOKIE['shopping_cart']) && (Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null && COUNT(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products']) > 0) ){

                $data_shopping_cart = Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']);
                $data_shopping_cart['happy_code'] = [

                    'code'      => $data_output_validate_param['response']['happy_code'],
                    'discount'  => $data_output_validate_param['response']['discount'],
                ];

                Cache::forget('shopping_cart_'.$_COOKIE['shopping_cart']);
                Cache::forever('shopping_cart_'.$_COOKIE['shopping_cart'], $data_shopping_cart);
                unset($data_output_validate_param['response']['id']);
            }
            else{
                $data_output_validate_param['meta']['success']  = false;
                $data_output_validate_param['meta']['msg']      = ['shopping_cart' => Lang::get('mesage.web.error.0031')];
                $data_output_validate_param['meta']['code']     = 0031;
                $data_output_validate_param['response']         = [];

            }
        }

        return $data_output_validate_param;
    }
}