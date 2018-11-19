<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Http\Models\Dashboard as ModelDashboard;
use Spr\Base\Response\Response;
use App\Http\Controllers\TransactionController as TransactionController;
use Input;
use Auth;
use Config;
use Redirect;
use Session;
use DB;
use Hash;
use Lang;

class DashboardController extends Controller
{

    public function getData() {


        $resutls = Response::response();
        $h          = "7";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
        $hm         = $h * 60;
        $ms         = $hm * 60;
        $gmdate     = gmdate("m/d/Y g:i:s A", time() + $ms);
        $startDate  = '';
        $endDate    = '';
        $data       = array();
        $count      = 15;

        for ($i = $count; $i > 0 ; $i--) {
            $now = date('Y-m-d', strtotime('-'.$i.' days', strtotime($gmdate)));
            if($i == $count) $startDate = strtotime($now) - $ms;
            array_push($data, array(
                'startTime'  => strtotime($now) - $ms,
                'endtime'    => strtotime('+1 days', strtotime($now)) - 1 - $ms,
                'date'       => $now,
                'total'      => 0,
                'success'    => 0,
            ));
        }

        $now = date('Y-m-d', strtotime($gmdate));
        array_push($data, array(
            'startTime'  => strtotime($now) - $ms,
            'endtime'    => strtotime('+1 days', strtotime($now)) - 1 - $ms,
            'date'       => $now,
            'total'      => 0,
            'success'    => 0,
        ));

        $count = 3;
        for ($i = 1; $i <= $count ; $i++) {

            $now = date('Y-m-d', strtotime('+'.$i.' days', strtotime($gmdate)));

            if($i == $count) $endDate = strtotime($now) - $ms;
            array_push($data, array(
                'startTime'  => strtotime($now) - $ms,
                'endtime'    => strtotime('+1 days', strtotime($now)) - 1 - $ms,
                'date'       => $now,
                'total'      => 0,
                'success'    => 0,
            ));
        }

        $ModelDashboard  = new ModelDashboard();
        $dataE           = $ModelDashboard->getOrder($startDate, $endDate);

        $countDataE  = COUNT($dataE['response']);
        $countData   = COUNT($data);

        for ($i=0; $i < $countDataE; $i++) {

            for ($j=0; $j < $countData; $j++) {

                if($dataE['response'][$i]->created_at >= $data[$j]['startTime'] && $dataE['response'][$i]->created_at <= $data[$j]['endtime']){

                    $data[$j]['total'] += 1;

                    if($dataE['response'][$i]->status == 1){

                        $data[$j]['success'] += 1;
                    }
                }
            }
        }
        for ($i=0; $i < $countData; $i++) {
            unset($data[$i]['startTime']);
            unset($data[$i]['endtime']);
            if($data[$i]['success'] == 0) unset($data[$i]['success']);
            if($data[$i]['total'] == 0) unset($data[$i]['total']);

        }

        $resutls['response'] = $data;

        return $resutls;
    }

    public function getDataAmount() {

        $count          = 12;
        $results        = Response::response();
        $arr_month      = [];
        $arr_amount     = [];
        $arr_tmp_amount = [];
        $this_year      = \Carbon\Carbon::now()->year;
        $this_month     = \Carbon\Carbon::now()->month;

        $data_output_validate_param = [

            'meta' => [
                'success' => true,
            ],
            'response' => [
                'limit'         => '30',
                'sort_type'     => '',
                'sort'          => '',
                'status'        => '',
                'key_search'    => '',
            ]
        ];

        for ($i = 1; $i <= $count ; $i++) {

            array_push($arr_month, array(
                'month'         => $i,
                'year'          => $this_year,
                'total_amount'  => 0,
                'amount_paid'   => 0,
            ));
        }

        $TransactionController  = new TransactionController();
        $data                = $TransactionController->getData($data_output_validate_param);

        foreach ($data['data']['response'] as $key => $item) {

            $month = (int)gmdate("m", $item->created_at);
            $arr_month[$month - 1]['total_amount']  += (float)$item->total_amount;
            $arr_month[$month - 1]['amount_paid']   += (float)$item->amount_paid;
        }

        $results['response'] = $arr_month;
        return $results;
    }
}