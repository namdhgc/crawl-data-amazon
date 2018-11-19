<?php

namespace App\Http\Controllers;

use App\Http\Models\Bank as ModelBank;
use Config;
use Input;
use Auth;
use Cache;


/**
* 
*/
class BankController extends Controller
{

    protected $table                = 'bank';
	
	function __construct()
	{
		# code...
	}

    public function insertUpdateData($data_output_validate_param) {

        // dd($data_output_validate_param);

        if ($data_output_validate_param['meta']['success']) {

            $id                 = $data_output_validate_param['response']['id'];
            $name               = $data_output_validate_param['response']['name'];
            $agency             = $data_output_validate_param['response']['agency'];
            $account_number     = $data_output_validate_param['response']['account_number'];
            $account_holder     = $data_output_validate_param['response']['account_holder'];
            $description        = $data_output_validate_param['response']['description'];
            $where      = [];
            
            $ModelBank = new ModelBank();

            $data = [
                'name'              => $name,
                'agency'            => $agency,
                'account_number'    => $account_number,
                'account_holder'    => $account_holder,
                'description'       => $description,
            ];

            if (isset($id) && $id != '') {
                
                //update
                $where = [
                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $id
                    ]
                ];

                $data['updated_at'] = strtotime(\Carbon\Carbon::now()->toDateTimeString());

                $results = ModelBank::updateData($this->table, $data, $where);

                $data_output_validate_param['meta']['code'] = 200;
                $data_output_validate_param['meta']['msg']  = ['Updated successful'];

            } else {

                //insert
                $where = [];

                // not exists record
                $data['created_at'] = strtotime(\Carbon\Carbon::now()->toDateTimeString());
                
                $results = ModelBank::insertData($this->table, $data, $where);

                $data_output_validate_param['meta']['code'] = 200;
                $data_output_validate_param['meta']['msg']  = ['Registered successful'];
                
            }
        }

        return $data_output_validate_param;
    }

    public function deleteData($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $id = $data_output_validate_param['response']['id'];

            $where = [
                [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id
                ]
            ];

            $data['deleted_at'] = strtotime(\Carbon\Carbon::now()->toDateTimeString());

            $results = ModelBank::updateData($this->table, $data, $where);

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
                    'operator' => 'raw',
                    'sql' =>  "(
                        name like '%".$key_search."%'

                        OR

                        agency like '%".$key_search."%'
                        
                        OR

                        account_number like '%".$key_search."%'
                        
                        OR

                        account_holder like '%".$key_search."%'
                        
                        OR

                        description like '%".$key_search."%'
                    )" 
                ],
            ];

            $order = [
                [
                    'fields'    => $sort,
                    'operator'  => $sort_type
                ]
            ];

            $results = ModelBank::selectData($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order );

            return array('data' => $results, 'sort' => $sort, 'limit' => $limit , 'sort_type' => $sort_type,  'key_search' => $key_search);
        } else {

            // return $data_output_validate_param['meta']['success'];
            $data_output_validate_param['response'] = array();

            return array('data' => $data_output_validate_param, 'sort' => $sort, 'limit' => $limit , 'sort_type' => $sort_type,  'key_search' => $key_search);
        }
    }

}