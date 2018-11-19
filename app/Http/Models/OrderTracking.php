<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Spr\Base\Response\Response;
use Spr\Base\Models\Helper;
use Config;
use DB;
use Auth;

/**
*
*/
class OrderTracking extends Model
{

	protected $table = "";

	public static function insertData($table, $data, $where) {

		$results = Helper::insertGetId($table, $data, $where);

		return $results;
	}

	public static function selectData($key_search, $limit, $sort, $sort_type) {

        try {
		    
            $query  =   DB::table('transaction as t')
                ->select('t.id','t.code','t.amazon_id','t.payment_method','t.payment_type','t.exchange_rate','t.price_list_id','t.status','t.verify','t.payment_status',
                    't.created_at',
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

            if($key_search != '' && $key_search != null) {

                $query = $query->whereRaw("

                    (

                        t.code like '%".$key_search."%'

                    )
                ");
            }
            $query = $query->where('ba.users_id','=', Auth::guard('customer')->user()->id)->get();
            
            $results['response']        = $query;

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['code'] = 401;
            $results['meta']['msg'] = $e->getMessage();
        }

		return $results;
	}

	public static function updateData($table, $data, $where) {

		$results = Helper::update_db($table, $data, $where);

		return $results;
	}

    public function getOrderTrackingDetail($code, $phone_number) {

        $results = null;

        try {

            $data = DB::table('transaction as t')
                            ->select('t.id','t.created_at','t.code','t.amazon_id','t.payment_method','t.payment_type','t.exchange_rate','t.price_list_id','t.status','t.verify','t.payment_status',
                                't.total_price_in_vn',
                                't.total_price_in_jp',
                                't.price_list_promotion_code',
                                't.price_list_happy_code',
                                't.total_fee',
                                't.total_amount',
                                't.amount_unpaid',
                                't.amount_paid',
                                't.deleted_at',
                                't.expected_day',
                                't.paid_before',
                                't.cost_incurred',
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
                            ->where('t.code','=',$code)->where('ba.phone_number','=',$phone_number)
                            ->get();

            $results['response'] = $data;

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg'] = $e->getMessage();
        }

        return $results;
    }

}