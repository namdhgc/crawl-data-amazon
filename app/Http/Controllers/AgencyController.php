<?php

namespace App\Http\Controllers;

use Input;
use Config;
use App\Http\Models\Agency as ModelAgency;
use Spr\Base\Response\Response;


/**
*
*/
class AgencyController extends Controller
{

	protected $table = "agency";

	function __construct()
	{
		# code...
	}

	public function insertData($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

            $name          	= $data_output_validate_param['response']['name'];
            $phone_number   = $data_output_validate_param['response']['phone_number'];
            $address     	= $data_output_validate_param['response']['address'];
            $country        = $data_output_validate_param['response']['country'];

            $where = [];

            $data = [
                'name'         		=> $name,
                'phone_number'  	=> $phone_number,
                'address'         	=> $address,
                'country'       	=> $country,
                'created_at'		=> strtotime(\Carbon\Carbon::now()->toDateTimeString())
            ];

            $ModelAgency = new ModelAgency();

            $result = $ModelAgency->insertData($this->table, $data, $where);

        } else {

            $data_output_validate_param['response'] = array();
            $data_output_validate_param['response']['data'] = $data_output_validate_param;
        }
        
        return $data_output_validate_param['response'];
    }

	public function updateData($data_output_validate_param) {

		// dd($data_output_validate_param);

		if ($data_output_validate_param['meta']['success']) {

			$where 		= [];

			$id 			= $data_output_validate_param['response']['id'];
			$name 			= $data_output_validate_param['response']['name'];
			$phone_number 	= $data_output_validate_param['response']['phone_number'];
			$address 		= $data_output_validate_param['response']['address'];
			$country 		= $data_output_validate_param['response']['country'];

			$data = [
				'name'			=> $name,
				'phone_number'	=> $phone_number,
				'address'		=> $address,
				'country'		=> $country,
			];

			if ($id == null || $id == '') {

				// insert data
				$data['created_at'] = strtotime(\Carbon\Carbon::now()->toDateTimeString());

				$id	= ModelAgency::insertData($this->table, $data, $where)['response'];

			} else {

				// update data
				$tmp = [
					'fields'	=> 'id',
					'operator'	=> '=',
					'value'		=> $id
				];
				array_push($where, $tmp);

				$data['updated_at'] = strtotime(\Carbon\Carbon::now()->toDateTimeString());

				$id	= ModelAgency::updateData($this->table, $data, $where);
			}
		}
		else {

			return $data_output_validate_param['meta']['success'];
		}
	}

	public function deleteData($data_output_validate_param) {

		if ($data_output_validate_param['meta']['success']) {


			$where 	= [];
			$data 	= [];

			$id 		= $data_output_validate_param['response']['id'];

			if (isset($id) && !empty($id)) {

				$tmp = [
					'fields'	=> 'id',
					'operator'	=> '=',
					'value'		=> $id
				];
				array_push($where, $tmp);

				$data['deleted_at'] = strtotime(\Carbon\Carbon::now()->toDateTimeString());

				$data = ModelAgency::updateData($this->table, $data, $where);
			}

		} else {

			return $data_output_validate_param['meta']['success'];
		}
	}

	public function getData($data_output_validate_param) {

		$sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search    	= $data_output_validate_param['response']['key_search'];

		if ($data_output_validate_param['meta']['success']) {

			$where = [
				[
					'operator' => 'raw',
					'sql' =>  "(
						name like '%".$key_search."%'

						OR

						phone_number like '%".$key_search."%'

						OR

						address like '%".$key_search."%'

						OR

						country like '%".$key_search."%'
					)" 
				]
			];

			$order = [
				[
					'fields' => $sort,
					'operator'	=> $sort_type
				]
			];

			$tmp = [
				'fields' 	=> 'deleted_at',
				'operator'	=> 'null'
			];
			array_push($where, $tmp);

			$results = ModelAgency::selectData($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order );

			// return $results;
			return array('data' => $results, 
							'sort' => $sort, 
							'limit' => $limit, 
							'sort_type' => $sort_type,
							'key_search' => $key_search
						);
		} else {

			// return $data_output_validate_param['meta']['success'];
			$data_output_validate_param['response'] = array();
            return array('data' => $data_output_validate_param, 
			            	'sort' => $sort, 
			            	'limit' => $limit, 
			            	'sort_type' => $sort_type,
			            	'key_search' => $key_search
		            	);
		}
	}
}