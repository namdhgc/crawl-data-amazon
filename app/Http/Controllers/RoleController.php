<?php

namespace App\Http\Controllers;

use Input;
use App\Http\Models\Role;
use App\Http\Models\Permission;
use Spr\Base\Response\Response;


/**
*
*/
class RoleController extends Controller
{

	protected $role_table 		= "roles";
	protected $permission_table = "permission_roles";

	function __construct()
	{
		# code...
	}

	// public function addRole($data_output_validate_param) {



	// 	if ($data_output_validate_param['meta']['success']) {

	// 		$where = [];

	// 		$name 		= $data_output_validate_param['response']['name'];
	// 		$remake 	= $data_output_validate_param['response']['remake'];


	// 		$data = [
	// 			'name'		=> $name,
	// 			'remake'	=> $remake
	// 		];

	// 		$data = Role::insertData($this->table, $data, $where);


	// 	} else {

	// 		return $data_output_validate_param['meta']['success'];
	// 	}
	// }

	public function updateRole($data_output_validate_param) {

		if ($data_output_validate_param['meta']['success']) {

			$role_where 		= [];
			$permission_where 	= [];

			$id 		= $data_output_validate_param['response']['id'];
			$name 		= $data_output_validate_param['response']['name'];
			$remake 	= $data_output_validate_param['response']['remake'];
			$permission = $data_output_validate_param['response']['permission'];

			$role_data = [
				'name'		=> $name,
				'remake'	=> $remake
			];

			$permission_data = [];

			if ($id == null || $id == '') {

				// insert data
				$role_id	= Role::insertData($this->role_table, $role_data, $role_where)['response'];

				$module = Permission::getAllModule();

				foreach ($module['response'] as $key => $item) {
					
					$tmp = [
						'module_id'		=> $item->id,
						'roles_id'		=> $role_id,
						'read'			=> 0,
						'write'			=> 0,
					];

					array_push($permission_data, $tmp);
				}

				$permission = Permission::insertData($this->permission_table, $permission_data);
			} else {

				// update data
				$tmp = [
					'fields'	=> 'id',
					'operator'	=> '=',
					'value'		=> $id
				];
				array_push($role_where, $tmp);

				$tmp = [
					'fields'	=> 'roles_id',
					'operator'	=> '=',
					'value'		=> $id
				];
				array_push($permission_where, $tmp);

				if (!empty($permission)) {
					foreach ($permission as $key => $value) {

						$permission_data[$value] = '1';
					}
				}

				$role_id	= Role::updateData($this->role_table, $role_data, $role_where);
				$permission = Permission::updateData($this->permission_table, $permission_data, $permission_where);
			}
		}
		else {

			return $data_output_validate_param['meta']['success'];
		}
	}

	public function getData($data_output_validate_param) {

		if ($data_output_validate_param['meta']['success']) {

			$where = [];

			$results = Role::selectData($this->role_table, $where);

			return $results;
		} else {

			return $data_output_validate_param['meta']['success'];
		}
	}

	public function deleteData($data_output_validate_param) {

		// echo "<pre>";
		// print_r($data_output_validate_param);
		// exit;

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

				$data = Role::updateData($this->role_table, $data, $where);
			}

		} else {

			return $data_output_validate_param['meta']['success'];
		}
	}
}