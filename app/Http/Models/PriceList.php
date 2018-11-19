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
class PriceList extends Model
{

    protected $table = "price_list";

    public  function insertData( $data) {

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
                'operator' => 'raw',
                'sql' =>  "(
                    name like '%".$key_search."%'

                    OR

                    description like '%".$key_search."%'
                )" 
            ],
            [
                'fields'    =>  'deleted_at',
                'operator'  =>  'null',
                'value'     =>  'NULL'

            ],
            [
                'fields'    =>  'kind',
                'operator'  =>  '=',
                'value'     =>  '0' // kind = 0 is price, kind = 1 is surcharge price
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

    public function checkIsPriceListDefault($id){

        $results = Response::response();

        try{

            $query  =   DB::table($this->table)
                        ->select(DB::raw('count(id) as total'))
                        ->where('id','=',$id)
                        ->where('type','=','0')
                        ->where('kind','=','0')
                        ->whereNull('deleted_at')
                        ->first();

            $results['response'] = $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;

    }

    public function checkTotalPriceListDefault(){

        $results = Response::response();

        try{

            $query  =   DB::table($this->table)
                        ->select(DB::raw('count(id) as total'))
                        ->where('type','=','0')
                        ->where('kind','=','0')
                        ->whereNull('deleted_at')
                        ->first();

            $results['response'] = $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

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

    public function getPriceListDefault () {

        $results =  Response::response();
        try {
            $query = DB::table('price_list');

            $query = $query->where('type','=',Config::get('spr.type.type.price.default.value'))
                            ->where('kind', '=', '0');

            $results['response'] = $query->get();

        }catch(Exception $e){
            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = Lang::get('message.web.error.0006');
        }
        return $results;
    }
}