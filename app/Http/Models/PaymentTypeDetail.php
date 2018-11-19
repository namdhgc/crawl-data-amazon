<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Response\Response;
use Spr\Base\Response\Response as BaseResponse;
use Spr\Base\Models\Helper;
use Config;
use DB;

/**
* 
*/
class PaymentTypeDetail extends Model
{

	protected $table = "payment_type_detail";

	public static function insertData($table, $data, $where) {

		$results = Helper::insertGetId($table, $data, $where);

		return $results;
	}

	public static function selectData($table, $where, $limit = null, $offset = null, $selectType = null, $fields = null, $order = null) {

		$results = Helper::select($table, $where, $limit, $offset, $selectType, $fields, $order);

		return $results;
	}

	public static function updateData($table, $data, $where) {

		$results = Helper::update_db($table, $data, $where);

		return $results;
	}

	public function getDataManage ($key_search, $limit, $sort, $sort_type, $payment_type_id) {

        $where = [
            [
                'fields' => 'title',
                'operator' => 'like',
                'value' => '%'. $key_search . '%',
            ],
            [
                'fields'    =>  'deleted_at',
                'operator'  =>  'null',
                'value'     =>  'NULL'
            ],
            [
                'fields'    =>  'payment_type_id',
                'operator'  =>  '=',
                'value'     =>  $payment_type_id
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

    public function getPaymentTypeDetailByPaymentTypeID($payment_type_id){

        $results    =   BaseResponse::response();

        try{

            $query = DB::table('payment_type as p')
                            ->select(
                                'c.id',
                                'c.title',
                                'c.description',
                                'c.type',
                                'c.payment_value',
                                'c.cost_incurred',
                                'c.specified_value',
                                'c.bonus'
                            )
                            ->join('payment_type_detail as c','p.id','=','c.payment_type_id')
                            ->where('c.payment_type_id','=',$payment_type_id)->whereNull('p.deleted_at')->whereNull('c.deleted_at');

            $results['response'] = $query->get();

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();

        }

        return $results;
    }

    public function getPaymentTypeDetailDefaultByPaymentTypeID($payment_type_id){

        $results    =   BaseResponse::response();

        try{

            $query = DB::table('payment_type as p')
                            ->select(
                                'c.id',
                                'c.title',
                                'c.description',
                                'c.type',
                                'c.payment_value',
                                'c.cost_incurred',
                                'c.specified_value',
                                'c.bonus'
                            )
                            ->join('payment_type_detail as c','p.id','=','c.payment_type_id')
                            ->where('c.payment_type_id','=',$payment_type_id)->where('c.type','=',0)->whereNull('p.deleted_at')->whereNull('c.deleted_at');

            $results['response'] = $query->first();
        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();

        }

        return $results;
    }
}