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
class ProductCategoryDetail extends Model
{

    protected $table = "product_category_detail";

    public  function insertData( $data) {
        $results = Helper::insert($this->table, $data);
        return $results;
    }

    public function updateData($data,$where = array()){
        $results =  Helper::update_db($this->table,$data,$where);
        return $results;
    }

    public function getDataWithClause($where = array()){
        $results =  Helper::select($this->table,$where);
        return $results;

    }

}