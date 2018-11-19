<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Response\Response;
use Spr\Base\Models\Helper;
use Config;
use Auth;
use DB;

/**
* 
*/
class FavoriteProduct extends Model
{

	protected $table = "favorite_product";

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

	public function checkExistsRecord($customer_id, $product_code) {

		try {

            $query = DB::table('favorite_product')
                                        ->select('id', 'customer_id', 'product_code', 'product_name', 'product_image')
                                        ->where('customer_id', '=', $customer_id)
                                        ->where('product_code', '=', $product_code);

            $results['response'] = $query->first();

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg']     = $e->getMessage();
        }

        return $results;
	}

	public function getDataManage ($key_search, $limit, $sort, $sort_type) {

        $where = [
        	[
        		'fields'    =>  'customer_id',
                'operator'  =>  '=',
                'value'     =>  Auth::guard('customer')->user()->id
        	],
            [
                'fields'    =>  'deleted_at',
                'operator'  =>  'null',
                'value'     =>  'NULL'
            ]
        ];

        $order = [
            [
                'fields' => $sort,
                'operator'  => $sort_type
            ]
        ];
        $results = Helper::select($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order );
        return $results;
    }
}