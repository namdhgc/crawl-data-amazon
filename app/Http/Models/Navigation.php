<?php

namespace App\Http\Models;

use DB;
use Spr\Base\Models\Helper;
use Illuminate\Database\Eloquent\Model;
use Spr\Base\Response\Response;
use Config;

class Navigation extends Model
{

	protected $table = "navigation";

    public  function insertData($data) {
        $results = Helper::insertGetId($this->table, $data);
        return $results;
    }

    public function updateData($data,$where = array()){
        $results =  Helper::update_db($this->table,$data,$where);
        return $results;

    }

    public function checkIsActive($id) {

        $results = Response::response();

        try{

            $query = DB::table($this->table)->select(DB::raw('count(id) as total'))->where('id','=',$id)->where('display','=',1)->whereNull('deleted_at')->first();

            $results['response'] = $query;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();
        }
        return $results;

    }


    public function totalActive($lang_code) {

        $results = Response::response();

        try{

            $query = DB::table($this->table)->select(DB::raw('count(id) as total'))->where('display','=','1')->where('lang_code','=',$lang_code)->whereNull('deleted_at')->first();

            $results['response'] = $query;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();
        }
        return $results;

    }

    public function checkIdExist($id) {

        $results = Response::response();

        try{

            $query = DB::table($this->table)->select(DB::raw('count(id) as total'))->where('id','=',$id)->whereNull('deleted_at')->first();

            $results['response'] = $query;
             

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();
        }
        return $results;

    }

	public function getData($where = array(), $limit = null, $offset = null, $selectType = null, $fields = null, $order = null){

        $results    =   Response::response();

        try{

            $query    =   DB::table('navigation as n')
                            ->select(
                                        'n.id',
                                        'n.link',
                                        'n.title',
                                        'n.description',
                                        'n.media_id',
                                        'n.lang_code',
                                        'n.display',
                                        'm.path'
                                    )
                            ->join('media as m','m.id','=','n.media_id');

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

    public function getDataForClient($lang_code){

        $results        =   Response::response();

        try{

            $query      =   DB::table('navigation as n')
                            ->select(
                                        'n.link',
                                        'n.title',
                                        'm.path'
                                    )
                            ->join('media as m','m.id','=','n.media_id')->where('n.lang_code','=',$lang_code)->whereNull('n.deleted_at')->where('display','1')->get();

            $results['response']       =    $query;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();

        }

        return $results;

    }
}