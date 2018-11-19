<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Response\Response;
use Spr\Base\Models\Helper;
use Config;
use DB;

/**
* 
*/
class HappyCode extends Model
{

	protected $table = "happy_code";

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

    public function getDataByCode($code) {

        $where = [
            [

                'fields' 	=> 'code',
                'operator' 	=> '=',
                'value' 	=> $code,
            ]
        ];
        $results = Helper::select($this->table, $where );
        return $results;
    }
}