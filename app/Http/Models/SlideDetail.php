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
class SlideDetail extends Model
{

	protected $table = "slide_detail";

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

	public function getData($where, $limit = null, $offset = null, $selectType = null, $fields = null, $order = null){

        $results    =   Response::response();

        try{

        	$query = DB::table('slide_detail as s')
	                ->join('media as m', 's.image_id', '=', 'm.id')
	                ->select('s.id', 's.title', 's.link', 's.mod_link', 's.image_id', 'm.path', 'm.tmp_path');

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

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();
        }
        return $results;

    }
}