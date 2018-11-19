<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\TransactionStatus as ModelTransactionStatus;
use Spr\Base\Controllers\Helper as HelperController;
use Intervention\Image\Exception\NotReadableException;
use Input;
use Config;
use Auth;
use Lang;
use Session;

class TransactionStatusController  extends Controller
{


    public function __construct()
    {
    }

    public function actionInsert_Update_TransactionStatus($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $where      = [];
            $id         = $data_output_validate_param['response']['id'];
            $name       = $data_output_validate_param['response']['name'];
            $description   = $data_output_validate_param['response']['description'];
            $data = [
                'name'      => $name,
                'description'    => $description
            ];

            $ModelTransactionStatus = new ModelTransactionStatus();

            if ($id == null || $id == '') {
                
                $id    = $ModelTransactionStatus->newTransactionStatus($data)['response'];
                $data_output_validate_param['response']['id'] = $id;
            } else {

                if($ModelTransactionStatus->checkIdExist($id)['response']->total > 0){

                    $tmp = [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $id
                    ];
                    array_push($where, $tmp);
                    $data_output_validate_param = $ModelTransactionStatus->updateData($data, $where);

                }else{

                    $data_output_validate_param['meta']['success'] = false;
                    $data_output_validate_param['meta']['msg']['id'] = Lang::get('message.web.error.0011');
                    Session::flash('msg', $data_output_validate_param['meta']['msg']);
                    return $data_output_validate_param;
                }
            }

            Cache::forget('transaction_status');
        }else{

            Session::flash('msg', $data_output_validate_param['meta']['msg']);

        }

        return $data_output_validate_param;
    }

    public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {

            $ModelTransactionStatus = new ModelTransactionStatus();

            $data = $ModelTransactionStatus->getDataManage($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response'] = array();
            $data_output_validate_param['response']['data'] = [];
        }

        return $data_output_validate_param['response'];
    }

    public function getDataSelectBox(){

        $ModelTransactionStatus = new ModelTransactionStatus();
        $data = $ModelTransactionStatus->getDataSelectBox();
        $data_output_validate_param['response'] = $data['response'];
        return $data_output_validate_param['response'];
        
    }

    public function deleteData($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $where      = [];
            $id         = $data_output_validate_param['response']['id'];
            $deleted_at       = $data_output_validate_param['response']['created_at'];
            $data = [
                'deleted_at'    => $deleted_at
            ];

            $ModelTransactionStatus = new ModelTransactionStatus();

            
            if($ModelTransactionStatus->checkIdExist($id)['response']->total > 0){

                $tmp = [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id
                ];
                if($ModelTransactionStatus->checkIsTransactionStatusDefault($id)['response']->total > 0) {

                    $data_output_validate_param['meta']['success'] = false;
                    $data_output_validate_param['meta']['msg']['id'] = 'Không thể xóa trạng thái mặc định';
                    Session::flash('msg', $data_output_validate_param['meta']['msg']);
                    return $data_output_validate_param;
                }
                array_push($where, $tmp);
                $data_output_validate_param = $ModelTransactionStatus->updateData($data, $where);
                Cache::forget('transaction_status');
            }else{  

                $data_output_validate_param['meta']['success'] = false;
                $data_output_validate_param['meta']['msg']['id'] = Lang::get('message.web.error.0011');
                Session::flash('msg', $data_output_validate_param['meta']['msg']);
                return $data_output_validate_param;
            }
        }else{

            Session::flash('msg', $data_output_validate_param['meta']['msg']);

        }

        return $data_output_validate_param;
    }

    public function changeStatusTransactionStatus($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){


            $id         = $data_output_validate_param['response']['id'];
            $type       = $data_output_validate_param['response']['type'];
            $updated_at = $data_output_validate_param['response']['updated_at'];

            $ModelTransactionStatus = new ModelTransactionStatus();
            $where  =   [];

            if($ModelTransactionStatus->checkIdExist($id)['response']->total > 0){
                $where  =   [

                    [

                        'fields'    =>  'id',
                        'operator'  =>  '=',
                        'value'     =>  $id,    
                    ]
                ];

                if($type == 0 && $ModelTransactionStatus->checkIsTransactionStatusDefault($id)['response']->total > 0){

                    $type = 1;

                }else{

                    $type = 0;

                }

                $data   =   [

                        'type'          =>  $type,
                        'updated_at'    =>  $updated_at
                ];

                if($type == 0 && $ModelTransactionStatus->checkIsTransactionStatusDefault($id)['response']->total == 0 
                    && $ModelTransactionStatus->checkTotalTransactionStatusDefault()['response']->total > 0)
                {
                    $data_output_validate_param['meta']['success']  = false;
                    $data_output_validate_param['meta']['msg']['status']      =   Lang::get('message.web.error.0027');   

                }else{

                    $result     =   $ModelTransactionStatus->updateData($data,$where);

                    if($result['meta']['success']){

                            $data_output_validate_param['meta']['msg']['status']    =   Lang::get('message.web.success.0001');
                             $data_output_validate_param['response']['type']      =   $type;

                    }else{

                            $data_output_validate_param['meta']['success']          =   false;
                            $data_output_validate_param['meta']['msg']['status']    =   Lang::get('message.web.error.0018');
                    }
                }  
            }
        }
        
        return $data_output_validate_param;

    }
}
?>