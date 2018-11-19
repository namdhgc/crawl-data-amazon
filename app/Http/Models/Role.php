<?php

namespace App\Http\Models;

use DB;
use Spr\Base\Models\Helper;
use Illuminate\Database\Eloquent\Model;

/**
*
*/
class Role extends Model
{

	protected $table = "roles";

	public static function insertData($table, $data, $where) {

		$results = Helper::insertGetId($table, $data, $where);

		return $results;
	}

	public static function selectData($table, $where) {

		$results = Helper::select($table, $where);

		return $results;
	}

	public static function updateData($table, $data, $where) {

		$results = Helper::update_db($table, $data, $where);

		return $results;
	}
}