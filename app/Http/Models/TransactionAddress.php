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
class TransactionAddress extends Model
{

    protected $table = "transaction_address";

    public  function insertData($data) {

        $results = Helper::insertGetId($this->table, $data);
        return $results;
    }

    public function getData($id) {


        $where = [
            [
                'fields'    => 'id',
                'operator'  => '=',
                'value'     => $id,
            ]
        ];

        $results = Helper::select($this->table, $where);
        return $results;
    }

    public function getDataByUserId($id) {


        $where = [
            [
                'fields'    => 'users_id',
                'operator'  => '=',
                'value'     => $id,
            ]
        ];

        $results = Helper::select($this->table, $where);
        return $results;
    }

    public function updateData( $data, $id) {

    	$where = [
            [
                'fields'    => 'id',
                'operator'  => '=',
                'value'     => $id,
            ]
        ];

        $results = Helper::update_db($this->table, $data, $where);

        return $results;
    }
}