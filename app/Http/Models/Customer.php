<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spr\Base\Models\Helper;
use Spr\Base\Response\Response;
use Config;
use DB;

class Customer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'customers';
    protected $guard = 'customer';

    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function insertData($data, $where = array()) {
        // $results = Helper::insertGetId($this->table, $data, $where);
        $results = Helper::insertGetId('customers', $data, $where);
        return $results;
    }

    public static function insertGetId($data) {

        $results = Helper::insertGetId("customers", $data);
        return $results;
    }

    public function updateData($data,$where = array()){
        $results =  Helper::update_db($this->table,$data,$where);

        return $results;
    }

    public static function getPhoneNumber($table,$id){

        $results = Response::response();

        try{

            $query  =   DB::table($table)
                        ->select('phone_number')
                        ->where('id','=',$id)
                        ->first();

            $results['response'] = $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;
    }

    public  function selectData($table, $where, $limit = null, $offset = null, $selectType = null, $fields = null, $order = null) {

        $results = Helper::select($table, $where, $limit, $offset, $selectType, $fields, $order);

        return $results;
    }

    public function getData($table,$id){

        $results = Response::response();

        try{

            $query  =   DB::table($table)
                        ->select('id','first_name','last_name','email','phone_number','address')
                        ->where('id','=',$id)
                        ->first();

            $results['response'] = $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;
    }

    public function getDataManage ($key_search, $limit, $sort, $sort_type) {


        $where = [
            [
                'operator' => 'raw',
                'sql' =>  "(
                    username like '%".$key_search."%'

                    OR

                    first_name like '%".$key_search."%'

                    OR

                    last_name like '%".$key_search."%'

                    OR

                    phone_number like '%".$key_search."%'

                    OR

                    email like '%".$key_search."%'
                )" 
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

    public function checkExistsUser($username, $token_reset_password = null) {

        try {

            $query = DB::table('customers')
                                        ->select('username', 'email', 'end_time_confirm')
                                        ->where('username', '=', $username);

            if (!is_null($token_reset_password)) {
                # code...
                $query->where('token_reset_password', '=', $token_reset_password);
            }

            $results['response'] = $query->first();

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg']     = $e->getMessage();
        }

        return $results;
    }

    public function getTotalCustomer() {

         try {

            $results['response'] = DB::table('customers')->count();
                                       
        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg']     = $e->getMessage();
        }

        return $results;
    }

    public function checkExistsUserByEmail($email, $token_reset_password = null) {

        try {

            $query = DB::table('customers')
                                        ->select('id','username', 'email', 'end_time_confirm')
                                        ->where('email', '=', $email);

            if (!is_null($token_reset_password)) {
                # code...
                $query->where('token_reset_password', '=', $token_reset_password);
            }

            $results['response'] = $query->first();

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg']     = $e->getMessage();
        }

        return $results;
    }

}
