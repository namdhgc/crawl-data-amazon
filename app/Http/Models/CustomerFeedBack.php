<?php

namespace App\Http\Models;

use DB;
use Spr\Base\Models\Helper;
use Illuminate\Database\Eloquent\Model;
use Spr\Base\Response\Response;
use Config;

class CustomerFeedback extends Model
{

	protected $table = "contact";

    public  function insertData($data) {
        $results = Helper::insertGetId($this->table, $data);
        return $results;
    }

    public function updateData($data,$where = array()){
        $results =  Helper::update_db($this->table,$data,$where);
        return $results;

    }

    public function getDataForUser($key_search, $limit, $sort, $sort_type){


        $where = [
            [

                'operator' => 'raw',
                'sql' =>  "(
                    email like '%".$key_search."%'

                    OR

                    phone_number like '%".$key_search."%'

                    OR

                    customer_name like '%".$key_search."%'

                )" 
            ],
            [
                'fields' => 'verify',
                'operator' => '=',
                'value' => '1',
            ],
            [
                'fields' => 'deleted_at',
                'operator' => 'null',
                'value' => 'NULL',
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

    public function getData($key_search, $limit, $sort, $sort_type){


        $where = [
            [
                'fields' => 'customer_name',
                'operator' => 'like',
                'value' => '%'. $key_search . '%',
            ],
            [
                'fields' => 'deleted_at',
                'operator' => 'null',
                'value' => 'NULL',
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

    public function checkVerified($id){

		$results = Response::response();

        try{

            $query = DB::table($this->table)->select(DB::raw('count(id) as total'))->where('id','=',$id)->where('verify','=',1)->first();

            $results['response'] = $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;
	}

	public function checkStatus($id){

		$results = Response::response();

        try{

            $query = DB::table($this->table)->select(DB::raw('count(id) as total'))->where('id','=',$id)->where('status','=',1)->first();

            $results['response'] = $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;
	}

    public function getPending () {

        $results    =   Response::response();

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