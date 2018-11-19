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
class FrequentlyAskedQuestion extends Model
{

	protected $table = "frequently_asked_question";

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

	public function getDataManage ($key_search, $limit, $sort, $sort_type) {

        $where = [
            [
                'operator' => 'raw',
                'sql' =>  "(
                    question like '%".$key_search."%'

                    OR

                    answer like '%".$key_search."%'
                )" 
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