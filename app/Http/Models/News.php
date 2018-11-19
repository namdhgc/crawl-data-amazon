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
class News extends Model
{

	protected $table = "news";

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

	public function getDataManage ($key_search, $limit = null, $sort = null, $sort_type = null) {

        $where = [
            [
                'operator' => 'raw',
                'sql' =>  "(
                    title like '%".$key_search."%'

                    OR

                    sub_description like '%".$key_search."%'
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


    public function getDataUser($key_search, $limit, $sort, $sort_type, $post_id = null) {
        $Response = new Response();
        $results = $Response->response(200,'','',true);

        $offset     = null;
        $selectType = null;
        $tmp        = null;

        $where = [
            [
                'fields' => 'n.title',
                'operator' => 'like',
                'value' => '%'. $key_search . '%',
            ],
            [
                'fields'    =>  'n.deleted_at',
                'operator'  =>  'null',
                'value'     =>  'NULL'
            ]
        ];

        if (isset($post_id) && $post_id != '') {
            
            $tmp = [
                'fields'    =>  'n.id',
                'operator'  =>  '=',
                'value'     =>  $post_id
            ];
            
            array_push($where, $tmp);
        }

        $order = [
            [
                'fields' => $sort,
                'operator'  => $sort_type
            ]
        ];  

        try {
            $query = DB::table('news as n')->select(
                                                'n.id',
                                                'n.title',
                                                'n.avatar',
                                                'n.description',
                                                'n.sub_description',
                                                'n.category_id',
                                                'n.lang_code',
                                                'n.created_by_id',
                                                'n.created_at',
                                                'm.path',
                                                'm.tmp_path'
                                            )
                                            ->join('media as m', 'n.avatar', '=', 'm.id');

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
            //  $last_query = end($queries);
            //  print_r($last_query);
                // exit;
            $results['response'] = $query;
        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['code'] = 401;
            $results['meta']['msg'] = $e->getMessage();
        }
        return $results;
    }

    public function getNewsForCategory() {

        $where = [
            [

                'fields'        =>  'deleted_at',
                'operator'      =>  'null',
            ]
        ];

        $results = Helper::select($this->table, $where);

        return $results;
    }
}