<?php
namespace App\Http\Models;

use DB;
use Spr\Base\Models\Helper;
use Illuminate\Database\Eloquent\Model;
use Spr\Base\Response\Response;
use lang;
use Config;
use Cache;
/**
*
*/
class Support extends Model
{

    protected $table = "support";

    public  function insertData( $data) {
        $results = Helper::insert($this->table, $data);
        return $results;
    }

    public function updateData($data,$where = array()){
        $results =  Helper::update_db($this->table,$data,$where);
        return $results;
    }

    public function getAvatarByID($id){

        $results = Response::response();

        try{

            $query  =   DB::table($this->table)
                        ->select('avatar')
                        ->where('id', '=', $id)
                        ->whereNull('deleted_at')
                        ->first();

            $results['response']    =   $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }
        return $results;

    }

    public function checkRecordExist($id){

        $results = Response::response();

        try{

            $query  =   DB::table($this->table)
                        ->select(DB::raw('count(id) as total'))
                        ->where('id', '=', $id)
                        ->whereNull('deleted_at')
                        ->first();

            $results['response']    =   $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }
        return $results;

    }  

    public function getDataForUser(){

       $results = Response::response();

        try{

            $query = DB::table($this->table.' as s')
                        ->select(
                            's.employee_name',
                            's.field_support',
                            's.phone',
                            'm.path'
                        )
                        ->join('media as m','m.id','=','s.avatar')
                        ->where('s.status','=',1)
                        ->whereNull('s.deleted_at')->get();

            $results['response'] = $query;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();
        }

        return $results;

    }

    public function getStatus($id){

        $results = Response::response();

        try{

            $query  =   DB::table($this->table)
                        ->select('status')
                        ->where('id', '=', $id)
                        ->whereNull('deleted_at')
                        ->first();

            $results['response']    =   $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }
        return $results;
    }

    public function getData($where, $limit = null, $offset = null, $selectType = null, $fields = null, $order = null){

        $results    =   Response::response();

        try{

            $query    =   DB::table($this->table.' as s')
                            ->select(
                                        's.id',
                                        's.employee_name',
                                        's.field_support',
                                        's.phone',
                                        's.status',
                                        'm.path'
                                    )
                            ->join('media as m','m.id','=','s.avatar');

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