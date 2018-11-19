<?php

namespace App\Http\Controllers;

use Input;
use App\Http\Models\Permission;
use Spr\Base\Response\Response;


/**
*
*/
class PermissionController extends Controller
{

	protected $table = "permission_roles";

	function __construct()
	{
		# code...
	}

	public function updatePermission($data_output_validate_param) {

		if ($data_output_validate_param['meta']['success']) {

			$data = $data_output_validate_param['response']['data'];

			foreach ($data as $key => $item) {

				$data 	= [

					$item['name'] => $item['status']
				];

				$where 	= [
					[
						'fields' 	=> 'roles_id',
						'operator' 	=> '=',
						'value'		=> $item['roles_id']
					],
					[
						'fields' 	=> 'module_id',
						'operator' 	=> '=',
						'value'		=> $item['module_id']
					]
				];
				$dataP = Permission::selectData($this->table, $where);
				$results = null;

				if($dataP['meta']['success'] && COUNT($dataP['response']) > 0) {

					$results = Permission::updateData($this->table, $data, $where);
				}else {

					$data['module_id'] = $item['module_id'];
					$data['roles_id'] = $item['roles_id'];
					$results = Permission::insertData($this->table, [$data]);
				}
			}
		} else {

			$data_output_validate_param['meta']['code'] 	= 500;
			$data_output_validate_param['meta']['msg'] 		= 'message.web.error.0007';
		}

		return $data_output_validate_param;
	}
}