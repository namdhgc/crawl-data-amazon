<?php

namespace App\Http\Controllers;

use Input;
use App\Http\Models\Role;
use App\Http\Models\PermissionRoles;
use Spr\Base\Response\Response;


/**
*
*/
class PermissionRolesController extends Controller
{

	protected $table = "permission_roles";

	function __construct()
	{
		# code...
	}

	public function getData($data_output_validate_param) {

		if ($data_output_validate_param['meta']['success']) {

			$roles_id = $data_output_validate_param['response']['roles_id'];

			$where = [
				[
					'fields'	=> 'roles_id',
					'operator'	=> '=',
					'value'		=> $roles_id
				]
			];

			$results = PermissionRoles::selectData($this->table, $where);
			
			return $results;
		} else {

			return $data_output_validate_param['meta']['success'];
		}
	}
}