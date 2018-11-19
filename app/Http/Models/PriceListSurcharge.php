<?php
namespace App\Http\Models;

use DB;
use Spr\Base\Models\Helper;
use Illuminate\Database\Eloquent\Model;
use Config;
/**
*
*/
class PriceListSurcharge extends Model
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
                'value'     =>  '1' // kind = 0 is price, kind = 1 is surcharge price
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
}