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
class PriceListSurchargeDetail extends Model
{

    protected $table = "price_list_detail";

    public  function insertData( $data) {

        $results = Helper::insertGetId($this->table, $data);

        return $results;
    }

    public function updateData($data,$where = array()){
        $results =  Helper::update_db($this->table,$data,$where);
        return $results;
    }

    public  function selectData($price_id) {
        $Response = new Response();
        $results =  $Response->response();
        try {
            $query = DB::table('price_list_detail as c')
                                ->select(
                                            'c.id',
                                            'c.price_id',
                                            'c.key',
                                            'c.value',
                                            'p.name'
                                        )
                                ->join('price_list as p', 'p.id', '=', 'c.price_id');

            $query = $query->where('c.price_id','=',$price_id)->whereNull('c.deleted_at');
            $query = $query->where('c.price_id','=',$price_id)->whereNull('c.deleted_at');

            $results['response'] = $query->get();

        }catch(Exception $e){
            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = Lang::get('message.web.error.0006');
        }
        return $results;
    }

    public function deleteData($where){

        $Response = new Response();
        $results =  $Response->response();
        try
        {
            $query = DB::table($this->table)->where($where)->delete();

            $results['response'] = $query;

        }catch(Exception $e){
            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = Lang::get('message.web.error.0006');
        }
        return $results;
    }

    public function getPriceListById ($id) {
        $where = [
            [
                'fields' => 'id',
                'value'  => $id,
                'operator' => '='
            ]
        ];
        $results =  Helper::select($this->table,$where);
        return $results;
    }

    public function getPriceListDefault () {

        $results =  Response::response();
        try {
            $query = DB::table('price_list_detail as c')
                                ->select(
                                            'c.key',
                                            'c.value'
                                        )
                                ->join('price_list as p', 'p.id', '=', 'c.price_id');
            $query = $query->where('p.type','=',Config::get('spr.type.type.price.default.value'));

            $results['response'] = $query->get();

        }catch(Exception $e){
            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = Lang::get('message.web.error.0006');
        }
        return $results;
    }
}