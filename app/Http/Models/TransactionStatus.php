<?php
namespace App\Http\Models;

use DB;
use Spr\Base\Models\Helper;
use Illuminate\Database\Eloquent\Model;
use Spr\Base\Response\Response;
use Config;
/**
*
*/
class TransactionStatus extends Model
{

    protected $table = "transaction_status";

    public  function newTransactionStatus( $data) {

        $results = Helper::insertGetId($this->table, $data);

        return $results;
    }

    public function updateData($data,$where = array()){
        $results =  Helper::update_db($this->table,$data,$where);
        return $results;
    }

    public function getDataManage ($key_search, $limit, $sort, $sort_type) {


        $where = [
            [
                'fields' => 'name',
                'operator' => 'like',
                'value' => '%'. $key_search . '%',
            ],
            [
                'fields' => 'deleted_at',
                'operator' => 'null',
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

    public function getDataDefault () {


        $where = [
            [
                'fields' => 'type',
                'operator' => '=',
                'value' => 0,
            ]
        ];
        
        $results = Helper::select($this->table, $where );
        return $results;
    }


    public function getDataSelectBox(){
        
        $where = [
            
            [
                'fields' => 'deleted_at',
                'operator' => 'null',
            ]
        ];
        $results =  Helper::select($this->table, $where);
        return $results;
    }

    public function checkIdExist($id) {

        $results = Response::response();

        try{

            $query = DB::table($this->table)->select(DB::raw('count(id) as total'))->where('id',$id)->whereNull('deleted_at')->first();

            $results['response'] = $query;
             

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();
        }
        return $results;

    }

    public function checkTotalTransactionStatusDefault(){

        $results = Response::response();

        try{

            $query  =   DB::table($this->table)
                        ->select(DB::raw('count(id) as total'))
                        ->where('type','=','0')
                        ->whereNull('deleted_at')
                        ->first();

            $results['response'] = $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;

    }

    public function checkIsTransactionStatusDefault($id){

        $results = Response::response();

        try{

            $query  =   DB::table($this->table)
                        ->select(DB::raw('count(id) as total'))
                        ->where('id','=',$id)
                        ->where('type','=','0')
                        ->whereNull('deleted_at')
                        ->first();

            $results['response'] = $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;

    }

}