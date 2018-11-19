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
class PaymentType extends Model
{

	protected $table = "payment_type";

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

	public function getDataManage ($key_search, $limit, $sort, $sort_type) {

        $where = [
            [
                'fields' => 'name',
                'operator' => 'like',
                'value' => '%'. $key_search . '%',
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


    public function checkExistsRecord($id, $type) {

        try {

            $query = DB::table($this->table)
                                        ->select('id', 'name', 'type')
                                        ->where('id', '=', $id)
                                        ->where('type', '=', $type);

            $results['response'] = $query->first();

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg']     = $e->getMessage();
        }

        return $results;
    }

    public function getDataByPaymentType($payment_type= null){

        $results    =   BaseResponse::response();

        try{

            $query = DB::table('payment_type as p')
                            ->select(

                                'c.title',
                                'c.description',
                                'c.type',
                                'c.payment_value',
                                'c.cost_incurred',
                                'c.specified_value',
                                'c.bonus'
                            )
                            ->join('payment_type_detail as c','p.id','=','c.payment_type_id');

            if($payment_type == null){

                $query->where('p.type','=',0)->whereNull('p.deleted_at')->whereNull('c.deleted_at');

            }else{
                $query->where('p.type','=',$payment_type)->whereNull('p.deleted_at')->whereNull('c.deleted_at');
            }

            $results['response'] = $query->get();
        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();

        }

        return $results;
    }

    public function getDefault () {

        $results =  BaseResponse::response();
        try {
            $query = DB::table('payment_type');

            $query = $query->where('type','=',Config::get('spr.type.type.price.default.value'));

            $results['response'] = $query->get();

        }catch(Exception $e){
            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = Lang::get('message.web.error.0006');
        }
        return $results;
    }
}