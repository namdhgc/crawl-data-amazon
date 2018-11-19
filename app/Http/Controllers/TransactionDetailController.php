<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\TransactionDetail as ModelTransactionDetail;
use App\Http\Models\Transaction as ModelTransaction;
use Spr\Base\Controllers\Helper as HelperController;
use Intervention\Image\Exception\NotReadableException;
use Input;
use Config;
use Auth;
use Lang;
use Session;

class TransactionDetailController  extends Controller
{


    public function __construct()
    {

    }


    public function deleteData($data_output_validate_param){

        $results    =   Response::response();

        if($data_output_validate_param['meta']['success']){

            $id                 =   $data_output_validate_param['response']['id'];
            $comment            =   $data_output_validate_param['response']['comment'];
            $deleted_at         =   $data_output_validate_param['response']['updated_at'];

            $ModelTransactionDetail =   new ModelTransactionDetail();

            if($ModelTransactionDetail->checkIdExist($id)['response']->total > 0){

                $where = [

                        [

                            'fields'    =>  'id',
                            'operator'  =>  '=',
                            'value'     =>  $id,
                        ]
                ];

                $data   =   [

                        'comment'       =>  $comment,
                        'deleted_at'    =>  $deleted_at

                ];

                $results    =   $ModelTransactionDetail->updateData($data,$where_sub);

                if($results['meta']['success']){


                        $data_output_validate_param['meta']['msg'] = Lang::get('message.web.success.0004');
                        Session::flash('msg', $data_output_validate_param['meta']['msg']);
                        return $data_output_validate_param;

                }else{

                        $data_output_validate_param['meta']['msg'] = Lang::get('message.web.error.0019');
                        Session::flash('msg', $data_output_validate_param['meta']['msg']);

                        return $data_output_validate_param;

                }

            }else{

                $data_output_validate_param['meta']['success']      =   false;
                $data_output_validate_param['meta']['msg']['id']    =   Lang::get('message.web.error.0011');;
                Session::flash('msg', $data_output_validate_param['meta']['msg']);

                return $data_output_validate_param;

            }

        }else{

            Session::flash('msg', $data_output_validate_param['meta']['msg']);

        }

        return $data_output_validate_param;

    }

    public function getData($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) 
        {
            $transaction_id = $data_output_validate_param['response']['t'];
            $sort           = $data_output_validate_param['response']['sort'];
            $limit          = $data_output_validate_param['response']['limit'];
            $sort_type      = $data_output_validate_param['response']['sort_type'];
            $where          =   [];
            $ModelTransactionDetail  =  new ModelTransactionDetail();
            $ModelTransaction        =  new ModelTransaction();   

            if($ModelTransaction->checkIdExist($transaction_id)['response']->total >0 ){

                $where = [

                        [

                            'fields'    =>  'transaction_id',
                            'operator'  =>  '=',
                            'value'     =>  $transaction_id,
                        ],
                        [

                            'fields'    =>  'deleted_at',
                            'operator'  =>  'null',
                            'value'     =>  'NULL'
                        ]
                ];

                $data               =   $ModelTransactionDetail->getDataManage($where, $limit, $sort, $sort_type);
                $exchange_rate      =   $ModelTransaction->getExchangeRateByID($transaction_id);

                $data_output_validate_param['response']['data']             =       $data;
                $data_output_validate_param['response']['exchange_rate']    =       $exchange_rate['response']->exchange_rate;

                
            }else{

                $data_output_validate_param['meta']['success'] = false;
                $data_output_validate_param['response']['data'] = [];
                $data_output_validate_param['response']['exchange_rate']    = 0;
            }

            
        }else {

            $data_output_validate_param['meta']['success'] = false;
            $data_output_validate_param['response']['data'] = [];
            $data_output_validate_param['response']['exchange_rate']    =      0;

        }

        return $data_output_validate_param;
    }

    public function getDataForAjax($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) 
        {
            $transaction_id = $data_output_validate_param['response']['t'];
            $where          =   [];
            $ModelTransactionDetail  =  new ModelTransactionDetail();
            $ModelTransaction        =  new ModelTransaction();   

            if($ModelTransaction->checkIdExist($transaction_id)['response']->total >0 ){

                $where = [

                        [

                            'fields'    =>  'transaction_id',
                            'operator'  =>  '=',
                            'value'     =>  $transaction_id,
                        ],
                        [

                            'fields'    =>  'deleted_at',
                            'operator'  =>  'null',
                            'value'     =>  'NULL'
                        ]
                ];

                $data               =   $ModelTransactionDetail->getDataNoPaginate($where);
                // $exchange_rate      =   $ModelTransaction->getExchangeRateByID($transaction_id);

                $data_output_validate_param['response']  =       $data['response'];
                // $data_output_validate_param['response']['exchange_rate']    =       $exchange_rate['response']->exchange_rate;

                
            }else{

                $data_output_validate_param['meta']['success'] = false;
                $data_output_validate_param['response']= [];
                // $data_output_validate_param['response']['exchange_rate']    = 0;
            }

            
        }else {

            $data_output_validate_param['meta']['success'] = false;
            $data_output_validate_param['response'] = [];
            // $data_output_validate_param['response']['exchange_rate']    =      0;

        }

        return $data_output_validate_param;
    }
}
?>