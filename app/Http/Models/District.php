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
class District extends Model
{

    protected $table = "districts";

    public  function insertData($data) {
        $results = Helper::insert($this->table, $data);
        return $results;
    }

    public function updateData($data,$where = array()){
        $results =  Helper::update_db($this->table,$data,$where);
        return $results;
    }

    public function getData($key_search, $limit, $sort, $sort_type) {


        $where = [
            [
                'fields'    => 'name',
                'operator'  => 'like',
                'value'     => '%'. $key_search . '%',
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


    public function getAllData() {


  
        
        $results = Helper::select($this->table);
        return $results;
    }

    public function getDistrictByCityID($id){

        $where = [
            [
                'fields'    => 'city_id',
                'operator'  => '=',
                'value'     => $id,
            ],
            [
                'fields'    =>  'deleted_at',
                'operator'  =>  'null',
                'value'     =>  'NULL'

            ]
        ];
        
        $results = Helper::select($this->table, $where);

        return $results;        
    }

}