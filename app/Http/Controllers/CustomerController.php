<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Http\Models\Customer as ModelCustomer;
use App\Http\Controllers\EmailController;
use Spr\Base\Response\Response;
use Input;
use Auth;
use Config;
use Redirect;
use Session;
use DB;
use Hash;
use Lang;

class CustomerController extends Controller
{

    // protected $table = 'customer';
    protected $table = 'customers';
    protected $mail;
    protected $type;

    function __construct() {

        $this->mail                     = new EmailController();
        $this->type                     = Config::get('spr.system.email_types.reset_password');
    }
	// protected $redirectTo = 'your redirect path after login';

    // protected function guard()
    // {
    //     // return Auth::guard('customer');
    //     return Auth::guard('users');
    // }

    public function login()
    {
        $results = Response::response();
        $username = Input::get('username');
        $password = Input::get('password');
        $active   = '1';
        
        if (!Auth::guard('customer')->attempt(['username' => $username, 'password' => $password])) {
            
            if (!Auth::guard('customer')->attempt(['email' => $username, 'password' => $password])) {
                
                if (!Auth::guard('customer')->attempt(['phone_number' => $username, 'password' => $password])) {
                    
                    $results['meta']['success'] = false;
                    $results['meta']['code'] = 209;
                    $results['meta']['msg'] = ['login' => 'Tên đăng nhập hoặc mật khẩu không đúng !'];

                }
            }
        }

        return $results;
    }

    public function checkResetPassword($data_output_validate_param) {

        $username               = $data_output_validate_param['response']['username'];
        $token_reset_password   = $data_output_validate_param['response']['token_reset_password'];
        $time_now               = strtotime(\Carbon\Carbon::now()->toDateTimeString());

        $ModelCustomer  = new ModelCustomer();
        $check      = $ModelCustomer->checkExistsUser($username, $token_reset_password);

        if ($check['response'] != null) {

            $end_time_confirm = $check['response']->end_time_confirm;

            if ($time_now < $end_time_confirm) {

                return true;
            } else {

                return false;
            }
        } else {

            return false;
        }
    }

    public function resetPassword($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $email = $data_output_validate_param['response']['email'];

            $ModelCustomer  = new ModelCustomer();
            $check      = $ModelCustomer->checkExistsUserByEmail($email);

            if ($check['response'] != null) {

                $time_now = strtotime(\Carbon\Carbon::now()->toDateTimeString());

                $data = [
                    'token_reset_password'  => csrf_token(),
                    'reset_password_at'     => $time_now,
                    'end_time_confirm'      => $time_now + Config::get('spr.system.reset_password.reset_password_time') * 60 * 60
                ];

                $where = [
                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $check['response']->id
                    ]
                ];


                $results = $ModelCustomer->updateData( $data, $where);

                $data['username'] = $check['response']->username;
                $data['is_admin'] = false;

                $data_output_validate_param['response'] = $this->mail->sendMail($this->type, $data, $check['response']->email);

            } else {

                $data_output_validate_param['meta']['success'] = false;
                $data_output_validate_param['meta']['code'] = 501;
                $data_output_validate_param['meta']['msg'] = ['forgot-pass' => 'Email không tồn tại'];
                $data_output_validate_param['response'] = [];
            }
        }

        return $data_output_validate_param;
    }

    public function actionResetPassword($data_output_validate_param) {

        $username               = $data_output_validate_param['response']['username'];
        $token_reset_password   = $data_output_validate_param['response']['token_reset_password'];
        $password               = $data_output_validate_param['response']['password'];
        $password_retype        = $data_output_validate_param['response']['password_retype'];
        $ModelCustomer              = new ModelCustomer();

        if ($password === $password_retype) {

            $check = $this->checkResetPassword($data_output_validate_param);

            if ($check == true) {

                $where = [
                    [
                        'fields'    => 'username',
                        'operator'  => '=',
                        'value'     => $username
                    ]
                ];

                $data = [
                    'password'              => Hash::make($password),
                    'token_reset_password'  => null,
                    'end_time_confirm'      => null
                ];

                $results = $ModelCustomer->updateData( $data, $where);

                $data_output_validate_param['meta']['msg']  = Lang::get('message.web.success.0003');
            } else {

                $data_output_validate_param['meta']['code']     = 500;
                $data_output_validate_param['meta']['success']  = false;
                $data_output_validate_param['meta']['msg']      = Lang::get('message.web.error.0015');
            }
        } else {

            $data_output_validate_param['meta']['code']     = 500;
            $data_output_validate_param['meta']['success']  = false;
            $data_output_validate_param['meta']['msg']      = Lang::get('message.web.error.0014');
        }
        return $data_output_validate_param;
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        Session::flush();

        return redirect('/');
    }

    public function getTotalUser() {

        $ModelCustomer = new ModelCustomer();

        return $ModelCustomer->getTotalCustomer();
    }

    public function insertData($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $username       = $data_output_validate_param['response']['username'];
            $password       = $data_output_validate_param['response']['password'];
            $retypePassword = $data_output_validate_param['response']['retypePassword'];
            $email          = $data_output_validate_param['response']['email'];
            $first_name     = $data_output_validate_param['response']['first_name'];
            $last_name      = $data_output_validate_param['response']['last_name'];
            $phone_number   = $data_output_validate_param['response']['phone_number'];

            if ( $password === $retypePassword ) {

            	$where = [];

	            $data = [
	                'username'      => $username,
	                'password'      => Hash::make($password),
	                'email'         => $email,
	                'first_name'    => $first_name,
	                'last_name'     => $last_name,
	                'phone_number'  => $phone_number,
	                'created_at' 	=> strtotime(\Carbon\Carbon::now()->toDateTimeString())
	            ];

	            $user_id = ModelCustomer::insertData( $data, $where)['response'];

                Auth::guard('customer')->loginUsingId($user_id);

	           	$data_output_validate_param['meta']['code'] = 200;
	            $data_output_validate_param['meta']['msg']  = [Lang::get('message.web.success.0003')];

            } else {

	            $data_output_validate_param['meta']['success']  = false;
	            $data_output_validate_param['meta']['code']  	= 500;
	            $data_output_validate_param['meta']['msg']  	= ['Error' => Lang::get('message.web.error.0014')];
            }

        }

      	return $data_output_validate_param;
    }

    public function insertCustomer($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

                $buyerFirstname     =   $data_output_validate_param['response']['buyerFirstname'];
                $buyerLastname      =   $data_output_validate_param['response']['buyerLastname'];
                $buyerPhone         =   $data_output_validate_param['response']['buyerPhone'];
                $buyerEmail         =   $data_output_validate_param['response']['buyerEmail'];
                $buyerAddress       =   $data_output_validate_param['response']['buyerAddress']. ','.
                                        $data_output_validate_param['response']['buyerCityID'] . ','.
                                        $data_output_validate_param['response']['buyerDistrictID'] . ','.
                                        $data_output_validate_param['response']['buyerWardID'];

                $receiverFirstname     =    $data_output_validate_param['response']['receiverFirstname'];
                $receiverLastname      =    $data_output_validate_param['response']['receiverLastname'];
                $receiverPhone         =    $data_output_validate_param['response']['receiverPhone'];
                $receiverEmail         =    $data_output_validate_param['response']['receiverEmail'];
                $receiverAddress       =    $data_output_validate_param['response']['receiverAddress']. ','.
                                            $data_output_validate_param['response']['receiverCityID'] . ','.
                                            $data_output_validate_param['response']['receiverDistrictID'] . ','.
                                            $data_output_validate_param['response']['receiverWardID'];

                $created_at         =   $data_output_validate_param['response']['created_at'];

            if(!Auth::guard('customer')->check()){

                if(strcmp($buyerPhone, $receiverPhone)!=0){

                    $result_buyer       = [];
                    $result_receiver       = [];

                    $data_buyer = [

                        'username'          =>      'Cus'.substr($created_at,0,5),
                        'password'          =>      Hash::make($created_at),
                        'first_name'        =>      $buyerFirstname,
                        'last_name'         =>      $buyerLastname,
                        'phone_number'      =>      $buyerPhone,
                        'email'             =>      $buyerEmail,
                        'address'           =>      $buyerAddress,
                        'created_at'        =>      $created_at

                    ];

                    $data_receiver = [

                        'username'          =>      'Cus'.substr($created_at,0,5),
                        'password'          =>      Hash::make($created_at),
                        'first_name'        =>      $receiverFirstname,
                        'last_name'         =>      $receiverLastname,
                        'phone_number'      =>      $buyerPhone,
                        'email'             =>      $buyerEmail,
                        'address'           =>      $buyerAddress,
                        'created_at'        =>      $created_at

                    ];

                    $result_buyer       = ModelCustomer::insertGetId($data_buyer);
                    $result_receiver    = ModelCustomer::insertGetId($data_receiver);

                    $data_output_validate_param['response']['buyer_id']             =   $result_buyer['response'];
                    $data_output_validate_param['response']['receiver_id']          =   $result_receiver['response'];
                    Session::put('buyer_id', $result_buyer['response']);
                    Session::put('receiver_id',$result_receiver['response']);

                }else{

                    $data_buyer = [

                        'username'          =>      'Cus'.substr($created_at,0,5),
                        'password'          =>      Hash::make($created_at),
                        'first_name'        =>      $receiverFirstname,
                        'last_name'         =>      $receiverLastname,
                        'phone_number'      =>      $buyerPhone,
                        'email'             =>      $buyerEmail,
                        'address'           =>      $buyerAddress,
                        'created_at'        =>      $created_at

                    ];

                    $result_buyer       = ModelCustomer::insertGetId($data_buyer);
                    $data_output_validate_param['response']['buyer_id']             =   $result_buyer['response'];
                    $data_output_validate_param['response']['receiver_id']          =   $result_buyer['response'];
                    Session::put('buyer_id', $result_buyer['response']);
                    Session::put('receiver_id',$result_buyer['response']);
                }

            }else{
                $id_buyer       =  Auth::guard('customer')->user()->id;

                $buyerPhone     =  Auth::guard('customer')->user()->phone_number;

                if(strcmp($buyerPhone, $receiverPhone) !=0){

                    $data_receiver = [

                        'username'          =>      'Cus'.substr($created_at,0,5),
                        'password'          =>      Hash::make($created_at),
                        'first_name'        =>      $receiverFirstname,
                        'last_name'         =>      $receiverLastname,
                        'phone_number'      =>      $buyerPhone,
                        'email'             =>      $buyerEmail,
                        'address'           =>      $buyerAddress,
                        'created_at'        =>      $created_at

                    ];
                    $result_receiver    = ModelCustomer::insertGetId( $data_receiver);

                    $data_output_validate_param['response']['buyer_id']             =   $id_buyer;
                    $data_output_validate_param['response']['receiver_id']          =   $result_receiver['response'];
                    Session::put('buyer_id', $id_buyer);
                    Session::put('receiver_id',$result_receiver['response']);

                }else{
                    $data_output_validate_param['response']['buyer_id']             =   $id_buyer;
                    $data_output_validate_param['response']['receiver_id']          =   $id_buyer;
                    Session::put('buyer_id', $id_buyer);
                    Session::put('receiver_id', $id_buyer);
                }

            }
        }

        return $data_output_validate_param;

    }

    public function getInforUserLogin($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){
            if(Auth::guard('customer')->check()){

                $user_id = Auth::guard('customer')->user()->id;
                $where = [
                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $user_id
                    ]
                ];

                $ModelCustomer  = new ModelCustomer();
                $data_output_validate_param['response']['data']    = $ModelCustomer->selectData($this->table, $where);
            }
        }
        return $data_output_validate_param;

    }
    public function getUserInformation($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $data_output_validate_param['response']['data']     =   [];

            if(Auth::guard('customer')->check()){
                $user_id        = Auth::guard('customer')->user()->id;
                $ModelCustomer  = new ModelCustomer();
                $where = [
                        [
                            'fields'    => 'id',
                            'operator'  => '=',
                            'value'     => $user_id
                        ]
                    ];

                $result         =   $ModelCustomer->selectData($this->table, $where);
                if($result['meta']['success']){

                    $data_output_validate_param['response']['data']    =  $result['response'];
                }
            }

        }
        return $data_output_validate_param['response'];
    }

    public function changeInformation($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $type                   = $data_output_validate_param['response']['type'];
            $first_name             = $data_output_validate_param['response']['first_name'];
            $last_name              = $data_output_validate_param['response']['last_name'];
            $old_password           = $data_output_validate_param['response']['old_password'];
            $new_password           = $data_output_validate_param['response']['new_password'];
            $new_password_retype    = $data_output_validate_param['response']['new_password_retype'];
            $time_now               = strtotime(\Carbon\Carbon::now()->toDateTimeString());
            $user_id                = Auth::guard('customer')->user()->id;
            $ModelCustomer          = new ModelCustomer();

            $where = [
                [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $user_id
                ]
            ];

            if ($type === 'user_information') {

                if (isset($first_name) && isset($last_name)
                    && $first_name != '' && $last_name != '') {

                    $data = [
                        'first_name'    => $first_name,
                        'last_name'     => $last_name
                    ];

                } else {

                    $data_output_validate_param['meta']['code'] = 500;
                    $data_output_validate_param['meta']['msg']  = [ Lang::get('message.web.error.0026') ];

                    return $data_output_validate_param;
                }
            }

            else if ($type == 'change_password') {

                if (isset($old_password) && isset($new_password) && isset($new_password_retype) && $old_password != '' && $new_password != '' && $new_password_retype != '') {

                    $user               = $ModelCustomer->selectData($this->table, $where);
                    $stored_password    = $user['response'][0]->password;

                    if (Hash::check($old_password, $stored_password)) {

                        if ($new_password !== $new_password_retype) {

                            $data_output_validate_param['meta']['code'] = 500;
                            $data_output_validate_param['meta']['msg']  = [ Lang::get('message.web.error.0014') ];

                            return $data_output_validate_param;

                        } else {

                            $data = [
                                'password'    => Hash::make($new_password)
                            ];
                        }
                    } else {

                        $data_output_validate_param['meta']['code'] = 500;
                        $data_output_validate_param['meta']['msg']  = [ Lang::get('message.web.error.0025') ];

                        return $data_output_validate_param;
                    }
                } else {

                    $data_output_validate_param['meta']['code'] = 500;
                    $data_output_validate_param['meta']['msg']  = [ Lang::get('message.web.error.0026') ];

                    return $data_output_validate_param;
                }
            }

            $results  = $ModelCustomer->updateData($data, $where);

            $data_output_validate_param['meta']['msg']      = [ Lang::get('message.web.success.0003') ];
            $data_output_validate_param['response']['data'] = $results;
        }

        return $data_output_validate_param;
    }


    public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {

            $ModelCustomer = new ModelCustomer();

            $data = $ModelCustomer->getDataManage($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response']['data'] = array();
        }

        return $data_output_validate_param['response'];
    }

    public function updateGroupCustomer($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

            $customer_id    = $data_output_validate_param['response']['id'];
            $group_customer = $data_output_validate_param['response']['group_customer'];

            // if (!isset($group_customer) || $group_customer == '') {
                
            //     $group_customer = '';
            // }

            $data = [
                'group_customer'    => $group_customer,
                'updated_at'        => strtotime(\Carbon\Carbon::now()->toDateTimeString())
            ];

            $where = [
                [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $customer_id
                ]
            ];

            $ModelCustomer  = new ModelCustomer();
            $results        = $ModelCustomer->updateData($data, $where);

            $data_output_validate_param['respomse']['data'] = $results;
        }

        return $data_output_validate_param;
    }

}