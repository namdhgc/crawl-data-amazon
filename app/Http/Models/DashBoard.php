<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Spr\Base\Response\Response;
use Spr\Base\Models\Helper;
use Config;
use Auth;
use DB;

/**
*
*/
class Dashboard extends Model
{

	protected $table = "transaction";

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

    

    public function getOrder($startDate, $endDate) {

        $where = [
            [
                'fields'    => 'created_at',
                'value'     => $endDate,
                'operator'  => "<=",
            ],
            [
                'fields'    => 'created_at',
                'value'     => $startDate,
                'operator'  => ">=",
            ]
        ];
        $results = Helper::select($this->table, $where);

        return $results;
    }
}