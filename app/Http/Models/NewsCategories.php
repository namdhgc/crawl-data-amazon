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
class NewsCategories extends Model
{

    protected $table = "news_categories";

    public  function insertData( $data) {

        $results = Helper::insertGetId($this->table, $data);

        return $results;
    }

    public function updateData($data,$where = array()){
        $results =  Helper::update_db($this->table,$data,$where);
        return $results;
    }

    public function getDataManage ($key_search, $limit = null, $sort = null, $sort_type = null) {

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

                'fields'        =>  'deleted_at',
                'operator'      =>  'null',
                'value'         =>  'NULL'  
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

    public function getSelectBox(){

        $results = Helper::select($this->table);
        return $results;
    }

    public function getAllCategory() {

        $where = [
            [

                'fields'        =>  'deleted_at',
                'operator'      =>  'null',
            ]
        ];

        $results = Helper::select($this->table, $where);

        return $results;
    }
}