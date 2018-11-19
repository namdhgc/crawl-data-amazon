<?php
namespace App\Http\Models;

use DB;
use Spr\Base\Models\Helper;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\TransactionStatus as ModelTransactionStatus;
use Spr\Base\Response\Response;
use Config;
/**
*
*/
class Transaction extends Model
{

    protected $table = "transaction";

    public  function newTransaction( $data) {

        $results = Helper::insertGetId($this->table, $data);

        return $results;
    }

    public function updateData($data,$where = array()){

        $results =  Helper::update_db($this->table,$data,$where);
        return $results;

    }

    public function deleteTransaction(){

    }

    public function getDataManage ($key_search,$status, $limit, $sort, $sort_type, $export = false) {

        $Response = new Response();
        $results = $Response->response(200,'','',true);

        $where = [
            [
                'operator' => 'raw',
                'sql' =>  "(

                    t.code like '%".$key_search."%'

                    OR

                    ba.email like '%".$key_search."%'

                    OR

                    ba.phone_number like '%".$key_search."%'

                )"
            ]
        ];

        if($status != '' && $status != null ) {

            array_push($where, [

                'fields'    =>  't.status',
                'operator'  =>  '=',
                'value'     =>  $status,
            ]);
        }

        $order = [
            [
                'fields' => $sort,
                'operator'  => $sort_type
            ]
        ];

        $offset     = null;
        $selectType = null;

        try {

            $query  =   DB::table($this->table.' as t')
                            ->select('t.id','t.code','t.amazon_id','t.payment_method','t.payment_type','t.exchange_rate','t.price_list_id','t.status','t.verify','t.payment_status',
                                't.created_at',
                                't.real_price',
                                't.total_price_in_vn',
                                't.total_price_in_jp',
                                't.price_list_promotion_code',
                                't.price_list_happy_code',
                                't.total_fee',
                                't.total_amount',
                                't.amount_unpaid',
                                't.amount_paid',
                                't.paid_before',
                                't.cost_incurred',
                                't.expected_day',
                                 DB::raw('(t.total_amount - t.paid_before) as remaining_amount, (t.total_price_in_jp - t.real_price) as difference'),
                                'ba.first_name as ba_first_name',
                                'ba.last_name as ba_last_name',
                                'ba.phone_number as ba_phone_number',
                                'ba.email as ba_email',
                                'ba.address as ba_address',
                                'bc.name as ba_city', 'bc.home_payment as ba_c_home_payment',
                                'bac.name as ba_districts', 'bac.home_payment as ba_d_home_payment',
                                'bw.name as ba_wards', 'bw.home_payment as ba_w_home_payment',

                                'ra.first_name as ra_first_name',
                                'ra.last_name as ra_last_name',
                                'ra.phone_number as ra_phone_number',
                                'ra.email as ra_email',
                                'ra.address as ra_address',
                                'rc.name as ra_city', 'rc.home_payment as ra_c_home_payment',
                                'rac.name as ra_districts', 'rac.home_payment as ra_d_home_payment',
                                'rw.name as ra_wards', 'rw.home_payment as ra_w_home_payment',

                                'hc.id as hc_id', 'hc.discount as hc_discount', 'hc.code as hc_code',
                                'pm.id as pm_id', 'pm.discount as pm_discount', 'pm.code as pm_code'
                            )
                            ->join('transaction_address as ba', 'ba.id','t.buyer_address_id')
                            ->join('transaction_address as ra', 'ra.id','t.receiver_address_id')
                            ->join('cities as bc', 'bc.id','=','ba.city_id')
                            ->join('districts as bac', 'bac.id','=','ba.district_id')
                            ->join('wards as bw', 'bw.id','=','ba.ward_id')
                            ->join('cities as rc', 'rc.id','=','ra.city_id')
                            ->join('districts as rac', 'rac.id','=','ra.district_id')
                            ->join('wards as rw', 'rw.id','=','ra.ward_id')
                            ->leftJoin('promotion as pm', 'pm.id','=','t.promotion')
                            ->leftJoin('happy_code as hc', 'hc.id','=','t.happy_code');

            foreach ($where as $key => $value) {

                switch ($value['operator']) {
                    case 'in':
                        $query = $query->whereIn($value['fields'], $value['value']);
                        break;
                    case 'null':
                        $query = $query->whereNull($value['fields']);
                        break;
                    case 'raw':
                        $query = $query->whereRaw($value['sql']);
                        break;
                    default:
                        $query = $query->where($value['fields'], $value['operator'], $value['value']);
                        break;
                }
            }

            if($export) {

                $query = $query->get();
            }else {

                $query = $query->paginate($limit);
            }

            $results['response'] = $query;

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['code'] = 401;
            $results['meta']['msg'] = $e->getMessage();
        }
        return $results;

    }

    public function checkIdExist($id){

        $results = Response::response();

        try{

            $query = DB::table($this->table)->select(DB::raw('count(id) as total'))->where('id','=',$id)->first();

            $results['response'] = $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;

    }

    public function getPending(){

        $results = Response::response();

        try{

            $ModelTransactionStatus = new ModelTransactionStatus();
            $data_status = $ModelTransactionStatus->getDataDefault();
            $status = '';
            if($data_status['meta']['success'] && COUNT($data_status['response']) > 0) {

                $status = $data_status['response']['0']->id;
            }

            if($status != '') {

                $query  =   DB::table($this->table)
                                ->select(DB::raw('count(transaction.id) as total'))
                                ->join('transaction_status', 'transaction_status.id','=','transaction.status')
                                // ->where('transaction_status.type','=',0)
                                ->where('transaction.status','=',$status)
                                ->whereNull('transaction.deleted_at')
                                ->first();

                $results['response'] = $query;
            }

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();
        }
        return $results;

    }

    public function getDataByCode($code) {

        $where = [
            [
                'value'     => $code,
                'fields'    => 'code',
                'operator'  => '='
            ]
        ];
        $results = Helper::select($this->table, $where);

        return $results;

    }

    public function checkCodeExist($code){

        $results = Response::response();

        try{

            $query = DB::table($this->table)->select('id')->where('code','=',$code)->first();

            $results['response'] = $query->id;

        }catch(Exception $ex){


            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;

    }

    public function getTransactionByStatus($beginData,$endDate,$status){

        $results = Response::response();

        try{

            $query  =   DB::table($this->table)
                            ->select('id','code','purchased_price','created_at','updated_at')
                            ->where('status','=',$status)
                            ->whereNull('deleted_at')
                            ->get();

            $results['response'] = $query;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();
        }
        return $results;

    }

    public function getInformationTransactionByCode ($code) {

        $results = Response::response();

        try{

            $query  =   DB::table($this->table.' as t')
                            ->select('t.id','t.code','t.amazon_id','t.payment_method','t.payment_type','t.exchange_rate','t.price_list_id','t.status','t.verify','t.payment_status',
                                't.total_price_in_vn',
                                't.real_price',
                                't.total_price_in_jp',
                                't.price_list_promotion_code',
                                't.price_list_happy_code',
                                't.total_fee',
                                't.total_amount',
                                't.amount_unpaid',
                                't.amount_paid',
                                't.deleted_at',
                                't.expected_day',
                                't.created_at',
                                't.paid_before',
                                't.cost_incurred',
                                't.vnpSecureHash',
                                'ptd.title',
                                DB::raw('(t.total_amount - t.paid_before) as remaining_amount'),
                                'ba.first_name as ba_first_name',
                                'ba.last_name as ba_last_name',
                                'ba.phone_number as ba_phone_number',
                                'ba.email as ba_email',
                                'ba.address as ba_address',
                                'bc.name as ba_city', 'bc.home_payment as ba_c_home_payment',
                                'bac.name as ba_districts', 'bac.home_payment as ba_d_home_payment',
                                'bw.name as ba_wards', 'bw.home_payment as ba_w_home_payment',

                                'ra.first_name as ra_first_name',
                                'ra.last_name as ra_last_name',
                                'ra.phone_number as ra_phone_number',
                                'ra.email as ra_email',
                                'ra.address as ra_address',
                                'rc.name as ra_city', 'rc.home_payment as ra_c_home_payment',
                                'rac.name as ra_districts', 'rac.home_payment as ra_d_home_payment',
                                'rw.name as ra_wards', 'rw.home_payment as ra_w_home_payment',

                                'hc.id as hc_id', 'hc.discount as hc_discount', 'hc.code as hc_code',
                                'pm.id as pm_id', 'pm.discount as pm_discount', 'pm.code as pm_code'
                            )
                            ->leftJoin('payment_type_detail as ptd','t.payment_type_detail','=','ptd.id')
                            ->join('transaction_address as ba', 'ba.id','t.buyer_address_id')
                            ->join('transaction_address as ra', 'ra.id','t.receiver_address_id')
                            ->join('cities as bc', 'bc.id','=','ba.city_id')
                            ->join('districts as bac', 'bac.id','=','ba.district_id')
                            ->join('wards as bw', 'bw.id','=','ba.ward_id')
                            ->join('cities as rc', 'rc.id','=','ra.city_id')
                            ->join('districts as rac', 'rac.id','=','ra.district_id')
                            ->join('wards as rw', 'rw.id','=','ra.ward_id')
                            ->leftJoin('promotion as pm', 'pm.id','=','t.promotion')
                            ->leftJoin('happy_code as hc', 'hc.id','=','t.happy_code')
                            ->where('t.code','=',$code)
                            ->first();
             $results['response'] = $query;
            }catch(Exception $ex){

                $results['meta']['success'] = false;
                $results['meta']['code']    =  500;
            }
            return $results;
    }


    public function getExchangeRateByID($id){


        $results = Response::response();

        try{

            $query = DB::table($this->table)->select('exchange_rate')->where('id',$id)->first();


            $results['response'] = $query;

        }catch(Exception $ex){


            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;

    }

    public function getCodeById($id){

        $results = Response::response();

        try{

            $query = DB::table($this->table)->select('code')->where('id','=',$id)->first();


            $results['response'] = $query;

        }catch(Exception $ex){


            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;

    }

    public function getInfoByCode($code,$phone_number = null) {

       $results = Response::response();

        try{

            $query = DB::table($this->table.' as t')
                        ->select(
                            't.code',

                            'ba.first_name as ba_first_name',
                            'ba.last_name as ba_last_name',
                            'ba.phone_number as ba_phone_number',
                            'ba.email as ba_email',
                            'ba.address as ba_address',

                            'bc.name as ba_city',
                            'bd.name as ba_district',
                            'bw.name as ba_ward',

                            'ra.first_name as ra_first_name',
                            'ra.last_name as ra_last_name',
                            'ra.phone_number as ra_phone_number',
                            'ra.address as ra_address',
                            'ra.email as ra_email',

                            'rc.name as ra_city',
                            'rd.name as ra_district',
                            'rw.name as ra_ward'
                            )
                        ->join('transaction_address as ba','t.buyer_address_id','=','ba.id')
                        ->join('transaction_address as ra','t.receiver_address_id','=','ra.id')

                        ->join('cities as bc','ba.city_id','=','bc.id')
                        ->join('districts as  bd','ba.district_id','=','bd.id')
                        ->join('wards as  bw','ba.ward_id','=','bw.id')

                        ->join('cities as rc','ra.city_id','=','rc.id')
                        ->join('districts as rd','ra.district_id','=','rd.id')
                        ->join('wards as  rw','ra.ward_id','=','rw.id')
                        ->where('t.code','=',$code);

            if($phone_number != null){
                $query  =   $query->where('ba.phone_number','=',$phone_number);

            }

            $results['response'] = $query->first();

        }catch(Exception $ex){


            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;

    }


    public function getInfoTransactionDetail($code,$payment_type = null){

        $results = Response::response();

        try{

            $query = DB::table($this->table.' as t')
                        ->select('t.code','t.created_at','t.expected_day','t.status','t.verify','ptd.title','t.payment_method')
                        ->leftJoin('payment_type_detail as ptd','t.payment_type_detail','=','ptd.id')
                        ->where('t.code','=',$code);

            if($payment_type != null){
                $query = $query->where('t.payment_type','=',$payment_type);
            }

            $results['response'] = $query->first();

        }catch(Exception $ex){


            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;

    }

    public function getDataByID($id){

        $results = Response::response();

        try{

            $query = DB::table($this->table)->where('id','=',$id)->first();

            $results['response'] = $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;

    }

    public function getOrderInfo($code){


    }

}