<?php

namespace App\Http\Models;

use DB;
use Config;
use Spr\Base\Models\Helper;
use Spr\Base\Response\Response;
use Illuminate\Database\Eloquent\Model;

/**
*
*/
class Permission extends Model
{

	protected $table = "permission_roles";

	public static function insertData($table, $data) {

		$results = Helper::insert($table, $data);

		return $results;
	}

	public static function updateData($table, $data, $where) {

		$results = Helper::update_db($table, $data, $where);

		return $results;
	}

	public static function selectData($table, $where = array(), $limit = null, $offset = null, $selectType = null, $fields = null, $order = null) {

		$Response = new Response();
		$results = $Response->response(200,'','',true);

		try {

			$query = DB::table('permission_roles as p')
								->select('p.id as permission_id',
											'p.module_id as permission_module_id',
											'p.roles_id',
											'p.read',
											'p.write',
											'm.id as module_id',
											'm.name',
											'm.status',
											'm.remake'
									)
			 					->join('module as m', 'm.id', '=', 'p.module_id');


			foreach ($where as $key => $value) {

				switch ($value['operator']) {
					case 'in':
						$query = $query->whereIn($value['fields'], $value['value']);
						break;
					case 'null':
						$query = $query->whereNull($value['fields']);
						break;
					default:
						$query = $query->where($value['fields'], $value['operator'], $value['value']);
						break;
				}
			}

			if(!is_null($limit)  && !is_null($offset) && $selectType != Config::get('spr.system.type.query.paginate')){
				$query = $query->take($limit)->skip($offset);
			}
			if($order !== null) {

				foreach ($order as $key => $value) {

					if($value['fields'] != ''){
						$query = $query->orderBy($value['fields'],$value['operator']);
					}
				}
			}

			switch ($selectType) {
				case Config::get('spr.system.type.query.count'):
				// DB::enableQueryLog();
					$query = $query->count();
					break;
				case Config::get('spr.system.type.query.max'):
					$query = $query->max($fields);
					break;
				case Config::get('spr.system.type.query.min'):
					$query = $query->min($fields);
					break;
				case Config::get('spr.system.type.query.paginate'):

					$query = $query->paginate($limit);
					break;
				default :
					$query = $query->get();
					break;
			}

			$results['response'] = $query;

		} catch (Exception $e) {

			$results['meta']['success'] = false;
			$results['meta']['code'] = 401;
			$results['meta']['msg'] = $e->getMessage();
		}

		return $results;
	}

	public static function getAllModule() {

		$where 		= [];
		$results 	= Helper::select('module', $where);

		return $results;
	}
}