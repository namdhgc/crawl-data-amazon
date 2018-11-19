<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Input;
use Auth;
use Config;
use Redirect;
use Session;
use App\Http\Models\User as ModelUser;
use App\Http\Controllers\EmailController;
use DB;
use Hash;
use Lang;
use Illuminate\Support\Facades\Crypt;
use Cache;

class UserController extends Controller
{

    protected $table = 'users';
    protected $mail;
    protected $type;

    function __construct() {

        $this->mail                     = new EmailController();
        $this->type                     = Config::get('spr.system.email_types.reset_password');
    }

	public function login()
    {

        $username = Input::get('username');
        $password = Input::get('password');
        $active   = '1';

        if (Auth::guard('web')->attempt(['username' => $username, 'password' => $password])) {


            return true;
        }else {
            if (Auth::guard('web')->attempt(['email' => $username, 'password' => $password])) {

                return true;
            }else {

                if (Auth::guard('web')->attempt(['phone_number' => $username, 'password' => $password])) {

                    return true;
                }else {
                    return false;
                }
            }
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        Session::flush();

        return redirect('/');
    }

    public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        $username       = $data_output_validate_param['response']['username'];
        $first_name     = $data_output_validate_param['response']['first_name'];
        $last_name      = $data_output_validate_param['response']['last_name'];
        $email          = $data_output_validate_param['response']['email'];
        $roles          = $data_output_validate_param['response']['roles'];

        if ($data_output_validate_param['meta']['success']) {

            $where = [];

            $order = [
                [
                    'fields' => $sort,
                    'operator'  => $sort_type
                ]
            ];

            $tmp = [
                'fields'    => 'deleted_at',
                'operator'  => 'null'
            ];
            array_push($where, $tmp);

            $tmp = [
                'fields'    => 'type',
                'operator'  => '=',
                'value'     => Config::get('spr.system.user_type.admin')
            ];
            array_push($where, $tmp);

            $tmp = [
                'fields'    => 'roles',
                'operator'  => '!=',
                'value'     => '1'
            ];
            array_push($where, $tmp);

            $tmp = [
                'fields'    => 'username',
                'operator'  => 'LIKE',
                'value'     => '%' . $key_search . '%'
            ];
            array_push($where, $tmp);

            // if ($username != null && $username != '') {

            //     $tmp = [
            //         'fields'    => 'username',
            //         'operator'  => 'LIKE',
            //         'value'     => '%' . $username . '%'
            //     ];
            //     array_push($where, $tmp);
            // }

            // if ($first_name != null && $first_name != '') {

            //     $tmp = [
            //         'fields'    => 'first_name',
            //         'operator'  => 'LIKE',
            //         'value'     => '%' . $first_name . '%'
            //     ];
            //     array_push($where, $tmp);
            // }

            // if ($last_name != null && $last_name != '') {

            //     $tmp = [
            //         'fields'    => 'first_name',
            //         'operator'  => 'LIKE',
            //         'value'     => '%' . $last_name . '%'
            //     ];
            //     array_push($where, $tmp);
            // }

            // if ($email != null && $email != '') {

            //     $tmp = [
            //         'fields'    => 'email',
            //         'operator'  => 'LIKE',
            //         'value'     => '%' . $email . '%'
            //     ];
            //     array_push($where, $tmp);
            // }

            // if ($roles != null && $roles != '') {

            //     $tmp = [
            //         'fields'    => 'roles',
            //         'operator'  => '=',
            //         'value'     => $roles
            //     ];
            //     array_push($where, $tmp);
            // }

            $results = ModelUser::selectData($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order );

            return array('data'             => $results,
                            'sort'          => $sort,
                            'limit'         => $limit ,
                            'sort_type'     => $sort_type,
                            'key_search'    => $key_search,
                            'username'      => $username,
                            'first_name'    => $first_name,
                            'last_name'     => $last_name,
                            'email'         => $email,
                            'roles'         => $roles,
                        );
        } else {

            $data_output_validate_param['response'] = array();

            return array('data'             => $data_output_validate_param,
                            'sort'          => $sort,
                            'limit'         => $limit ,
                            'sort_type'     => $sort_type,
                            'key_search'    => $key_search,
                            'username'      => $username,
                            'first_name'    => $first_name,
                            'last_name'     => $last_name,
                            'email'         => $email,
                            'roles'         => $roles,
                        );
        }
    }

    public function insertData($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $username       = $data_output_validate_param['response']['username'];
            $email          = $data_output_validate_param['response']['email'];
            $password       = $data_output_validate_param['response']['password'];
            $first_name     = $data_output_validate_param['response']['first_name'];
            $last_name      = $data_output_validate_param['response']['last_name'];
            $name_kana      = $data_output_validate_param['response']['name_kana'];
            $phone_number   = $data_output_validate_param['response']['phone_number'];
            $address        = $data_output_validate_param['response']['address'];
            $roles          = $data_output_validate_param['response']['roles'];

            $filename       = $data_output_validate_param['response']['avatar'];
            $path           = public_path('images');

            move_uploaded_file($filename, $path . '/abc.jpg');

            $where = [];

            if(!isset(Cache::get('permissionRoles')[$roles])) $roles = null;
            $data = [
                'username'      => $username,
                'email'         => $email,
                'password'      => Hash::make($password),
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'name_kana'     => $name_kana,
                'phone_number'  => $phone_number,
                'address'       => $address,
                'roles'         => $roles
            ];

            $data['created_time'] = strtotime(\Carbon\Carbon::now()->toDateTimeString());

            $id = User::insertData($this->table, $data, $where)['response'];

        } else {

            return $data_output_validate_param['meta']['success'];
        }
    }

    public function resetPassword($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $email = $data_output_validate_param['response']['email'];

            $ModelUser  = new ModelUser();
            $check      = $ModelUser->checkExistsUserByEmail($email);

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


                $results = $ModelUser->updateData('users', $data, $where);

                $data['username'] = $check['response']->username;
                $data['is_admin'] = true;

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

    public function checkResetPassword($data_output_validate_param) {

        $username               = $data_output_validate_param['response']['username'];
        $token_reset_password   = $data_output_validate_param['response']['token_reset_password'];
        $time_now               = strtotime(\Carbon\Carbon::now()->toDateTimeString());

        $ModelUser  = new ModelUser();
        $check      = $ModelUser->checkExistsUser($username, $token_reset_password);

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

    public function actionResetPassword($data_output_validate_param) {

        $username               = $data_output_validate_param['response']['username'];
        $token_reset_password   = $data_output_validate_param['response']['token_reset_password'];
        $password               = $data_output_validate_param['response']['password'];
        $password_retype        = $data_output_validate_param['response']['password_retype'];
        $ModelUser              = new ModelUser();

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

                $results = $ModelUser->updateData('users', $data, $where);

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

    public function blockAdmin ($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $id             = $data_output_validate_param['response']['id'];
            $blocked        = $data_output_validate_param['response']['blocked'];

            if($blocked == '0' || $blocked == 0) $blocked = 1;
            else $blocked = 0;
            $data = [
                'blocked'       => $blocked,
                'updated_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString())
            ];

            $where = [
                [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id
                ]
            ];

            $results = ModelUser::updateData($this->table, $data, $where);

            $data_output_validate_param['response']['blocked'] = $blocked;
            $data_output_validate_param['response']['data'] = $results;
        }

        return $data_output_validate_param;

    }

    public function updateAdminInformation($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $id             = $data_output_validate_param['response']['id'];
            $roles          = $data_output_validate_param['response']['roles'];
            $email          = $data_output_validate_param['response']['email'];
            $phone_number   = $data_output_validate_param['response']['phone_number'];
            $first_name     = $data_output_validate_param['response']['first_name'];
            $last_name      = $data_output_validate_param['response']['last_name'];

            if(!isset(Cache::get('permissionRoles')[$roles])) $roles = null;
            $data = [
                'roles'         => $roles,
                'email'         => $email,
                'phone_number'  => $phone_number,
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'updated_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString())
            ];

            $where = [
                [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id
                ]
            ];

            $results = ModelUser::updateData($this->table, $data, $where);

            $data_output_validate_param['response']['data'] = $results;
        }

        return $data_output_validate_param;
    }

    public function deleteAdminInformation($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $id                 = $data_output_validate_param['response']['id'];
            $data['deleted_at'] = strtotime(\Carbon\Carbon::now()->toDateTimeString());

            $where = [
                [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id
                ]
            ];

            $results = ModelUser::updateData($this->table, $data, $where);

            $data_output_validate_param['response']['data'] = $results;
        }

        return $data_output_validate_param;
    }

    public function addManagerAdmin($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $username       = $data_output_validate_param['response']['username'];
            $password       = $data_output_validate_param['response']['password'];
            $roles          = $data_output_validate_param['response']['roles'];
            $email          = $data_output_validate_param['response']['email'];
            $first_name     = $data_output_validate_param['response']['first_name'];
            $last_name      = $data_output_validate_param['response']['last_name'];
            $phone_number   = $data_output_validate_param['response']['phone_number'];
            $address        = $data_output_validate_param['response']['address'];
            $type           = 0; // 0 is Admin, 1 is customer


            $where = [];

            $data = [
                'username'      => $username,
                'password'      => Hash::make($password),
                'roles'         => $roles,
                'email'         => $email,
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'phone_number'  => $phone_number,
                'address'       => $address,
                'type'          => $type,
            ];

            $data['created_at'] = strtotime(\Carbon\Carbon::now()->toDateTimeString());

            $id = ModelUser::insertData($this->table, $data, $where)['response'];

        } else {

            return $data_output_validate_param['meta']['success'];
        }
    }

    public function changePassword($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $old_password           = $data_output_validate_param['response']['old_password'];
            $new_password           = $data_output_validate_param['response']['new_password'];
            $new_password_retype    = $data_output_validate_param['response']['new_password_retype'];
            $user_id                = Auth::user()->id;
            $ModelUser              = new ModelUser();

            $where = [
                [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $user_id
                ]
            ];

            if (isset($old_password) && isset($new_password) && isset($new_password_retype) && $old_password != '' && $new_password != '' && $new_password_retype != '') {

                $user               = $ModelUser->selectData($this->table, $where);
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

            $results  = $ModelUser->updateData($this->table, $data, $where);

            $data_output_validate_param['meta']['msg']      = [ Lang::get('message.web.success.0003') ];
            $data_output_validate_param['response']['data'] = $results;
        }

        return $data_output_validate_param;
    }
}