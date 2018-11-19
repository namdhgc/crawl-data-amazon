<?php

namespace App\Http\Models;

use DB;
use Spr\Base\Models\Helper;
use Spr\Base\Response\Response;
use Illuminate\Database\Eloquent\Model;
use Config;

class GroupCustomer extends Model
{

	protected $table = "group_customer";

    public  function insertData($data) {
        $results = Helper::insertGetId($this->table, $data);
        return $results;
    }

    public function updateData($data,$where = array()){
        $results =  Helper::update_db($this->table,$data,$where);
        return $results;
    }
   
   	public function getDataById($id){

   		$where = [
   			[
   				'fields' => 'id',
   				'value'	 => $id,
   				'operator' => '='
   			]
   		];
        $results =  Helper::select($this->table,$where);
        return $results;
    }

    public function getDataManage ($key_search, $limit, $sort, $sort_type) {

        // $results = Helper::select($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order );

        $Response   = new Response();
        $results    = $Response->response(200,'','',true);
        $offset     = null;
        $selectType = Config::get('spr.system.type.query.paginate');

        $where = [
            [
                'operator' => 'raw',
                'sql' =>  "(
                    gc.name like '%".$key_search."%'

                    OR

                    pl.name like '%".$key_search."%'

                    OR

                    pt.name like '%".$key_search."%'
                )" 
            ],
            [
                'fields'    =>  'gc.deleted_at',
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

        try {
            $query = DB::table('group_customer as gc')->select(
                                                        'gc.id',
                                                        'gc.name as group_customer_name',
                                                        'gc.price_list_id',
                                                        'gc.payment_type_id',
                                                        'gc.created_at',
                                                        'gc.updated_at',
                                                        'gc.deleted_at',
                                                        'pl.name as price_list_name',
                                                        'pt.name as payment_type_name'
                                                        )
                                                        ->join('price_list as pl', 'gc.price_list_id', '=', 'pl.id')
                                                        ->join('payment_type as pt', 'gc.payment_type_id', '=', 'pt.id');

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
}