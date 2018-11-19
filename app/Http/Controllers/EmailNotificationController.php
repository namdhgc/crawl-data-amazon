<?php

namespace App\Http\Controllers;

use App\Http\Models\EmailNotification;
use Config;
use Input;
use Auth;


/**
* 
*/
class EmailNotificationController extends Controller
{

	protected $table = 'email_notification';
	
	function __construct()
	{
		# code...
	}

    public function insertData($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $where      = [];
            $email      = $data_output_validate_param['response']['email'];

            $data = [
                'email'         => $email,
                'created_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString()),
            ];

            $results = EmailNotification::insertData($this->table, $data, $where);

            $data_output_validate_param['meta']['code'] = 200;
            $data_output_validate_param['meta']['msg']  = ['Inserted successful'];

        }

        return $data_output_validate_param;
    }

    public function getData($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $sort           = $data_output_validate_param['response']['sort'];
            $limit          = $data_output_validate_param['response']['limit'];
            $sort_type      = $data_output_validate_param['response']['sort_type'];
            $key_search     = $data_output_validate_param['response']['key_search'];

            $where = [
                [
                    'operator' => 'raw',
                    'sql' =>  "(
                        email like '%".$key_search."%'
                    )" 
                ]
            ];

            $order = [
                [
                    'fields'    => $sort,
                    'operator'  => $sort_type
                ]
            ];

            $results = EmailNotification::selectData($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order );

            return array('data' => $results, 
                            'sort'          => $sort, 
                            'limit'         => $limit , 
                            'sort_type'     => $sort_type,
                            'key_search'    => $key_search
                        );
        } else {

            // return $data_output_validate_param['meta']['success'];
            $data_output_validate_param['response'] = array();

            return array('data' => $data_output_validate_param, 
                            'sort'          => $sort, 
                            'limit'         => $limit , 
                            'sort_type'     => $sort_type,
                            'key_search'    => $key_search,
                        );
        }
    }
}