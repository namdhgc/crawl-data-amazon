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
class TransactionDetail extends Model
{

    protected $table = "transaction_detail";

    public  function insertData( $data) {

        $results = Helper::insert($this->table, $data);

        return $results;
    }

    public function updateData($data,$where = array()){

        $results =  Helper::update_db($this->table,$data,$where);
        return $results;
    }


    public function getDataManage ($where, $limit, $sort, $sort_type) {

        $order = [

            [
                'fields' => $sort,
                'operator'  => $sort_type
            ]
        ];
        $results = Helper::select($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, null );
        return $results;
    }

    public function getDataNoPaginate($where) {
        $results = Helper::select($this->table, $where);
        return $results;
    }

    public function checkIdExist($id){

        $results = Response::response();

        try{

            $query = DB::table($this->table)->select(DB::raw('count(id) as total'))->where('id',$id)->first();

            $results['response'] = $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;

    }

    public function getDataByTransactionId($id,$code = null) {

        $where   =  [
                [
                    'fields'    => 'transaction_id',
                    'operator'  => '=',
                    'value'     => $id,
                    
                ],
                [
                    'fields'    =>  'deleted_at',
                    'operator'  =>  'null',
                    'value'     =>  'NULL'
                    
                    
                ]
        ];

        if($code != null){
            $tmp = [
                'fields'    => 'product_code',
                'operator'  => '=',
                'value'     => $code,
            ];
            array_push($where, $tmp);

        }
        
        $results = Helper::select($this->table, $where);
        return $results;
    }


    public function getDataByTransactionCode($code) {

       $results = Response::response();

        try{

            $query = DB::table($this->table.' as td')
                        ->select(
                                't.exchange_rate',
                                'td.price',
                                'td.product_code',
                                'td.name',
                                'td.img',
                                'td.price_in_vn',
                                'td.type_product',
                                'td.price_list_detail',
                                'td.quantity'
                            )
                        ->join('transaction as t','t.id','=','td.transaction_id')
                        ->where('t.code','=',$code);  

            $results['response'] = $query->get();

        }catch(Exception $ex){


            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;
    }

}