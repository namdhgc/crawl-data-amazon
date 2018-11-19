<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Spr\Base\Response\Response;
use Spr\Base\Models\Helper;
use Config;
use DB;

/**
* 
*/
class OrderHappyCode extends Model
{

	protected $table = "happy_code_order";

	public static function insertData($table, $data, $where) {

		$results = Helper::insertGetId($table, $data, $where);

		return $results;
	}

	public static function selectData($table, $where, $limit = null, $offset = null, $selectType = null, $fields = null, $order = null) {

		$results = Helper::select($table, $where, $limit, $offset, $selectType, $fields, $order);

		return $results;
	}

	public static function updateData($table, $data, $where) {

		$results = Helper::update_db($table, $data, $where);

		return $results;
	}

	public function checkExistshappyCode($code) {

        try {

            $query = DB::table($this->table)
                                        ->select('code', 'status')
                                        ->where('code', '=', $code);

            $results['response'] = $query->first();

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg']     = $e->getMessage();
        }

        return $results;
    }

    public function getDataManage($table, $where = array(), $limit = null, $offset = null, $selectType = null, $fields = null, $order = null ) {

    	$Response 	= new Response();
		$results 	= $Response->response(200,'','',true);

		try {

			$query = DB::table('happy_code_order as h')
                                        ->select('h.id as happy_code_order_id',
                                        		'h.buyer_id',
                                        		'h.payment_type',
                                        		'h.happy_code_type',
                                        		'h.code',
                                        		'h.status',
                                        		'h.effective_at',
                                        		'h.expired_at',
                                        		'h.updated_at',
                                        		'u.id',
                                        		'u.username',
                                        		'u.email',
                                        		'u.first_name',
                                        		'u.last_name',
                                        		'u.phone_number',
                                        		'u.address'
                                        	)
            							->join('customers as u', 'h.buyer_id', '=', 'u.id');

			foreach ($where as $key => $value) {

				switch ($value['operator']) {
					case 'in':
						$query = $query->whereIn($value['fields'], $value['value']);
						break;
					case 'null':
						$query = $query->whereNull($value['fields']);
						break;
					case 'raw':
						$query = $query->whereRaw($value['sql']);
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

			DB::enableQueryLog();

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
			// $queries = DB::getQueryLog();
			// 	$last_query = end($queries);
			// 	print_r($last_query);
				// exit;
			$results['response'] = $query;
		} catch (PDOException $e) {

			$results['meta']['success'] = false;
			$results['meta']['code'] = 401;
			$results['meta']['msg'] = $e->getMessage();
		}

        return $results;
    }
}