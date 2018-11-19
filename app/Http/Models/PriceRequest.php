<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Spr\Base\Models\Helper;
use Spr\Base\Response\Response;
use Config;
use DB;

/**
* 
*/
class PriceRequest extends Model
{

	protected $table = "price_request";

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

	public static function selectStatus($id) {

		try {

			$results = DB::table('price_request')->where([
													['status', '=', 1],
													['id', '=', $id]
												])->first();
			
		} catch (Exception $e) {

			$results['meta']['success'] = false;
			$results['meta']['msg'] = $e->getMessage();
		}

      	return $results;
	}

	public  function getPending(){

		$results 	= 	Response::response();

        try{

            $query  =   DB::table($this->table)
                            ->select(DB::raw('count(id) as total'))
                            ->where('status','=','0')
                            ->whereNull('deleted_at')
                            ->first();

            $results['response'] = $query;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();
        }
        return $results;
	}
}