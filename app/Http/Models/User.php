<?php

namespace App\Http\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spr\Base\Models\Helper;
use Spr\Base\Response\Response;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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

    public function checkExistsUser($username, $token_reset_password = null) {

        try {

            $query = DB::table('users')
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

    public function checkExistsUserByEmail($email, $token_reset_password = null) {

        try {

            $query = DB::table('users')
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

    public static function updateData($table, $data, $where) {

        $results = Helper::update_db($table, $data, $where);

        return $results;
    }

    public static function insertData($table, $data, $where = array()) {

        $results = Helper::insertGetId($table, $data, $where);

        return $results;
    }

    public static function selectData($table, $where, $limit = null, $offset = null, $selectType = null, $fields = null, $order = null) {

        $results = Helper::select($table, $where, $limit, $offset, $selectType, $fields, $order);

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

    public function checkExistsRecord($data = array()) {

        try {

            $query = DB::table('users')->where($data['fields'], '=', $data['value']);

            

            $results['response'] = $query->first();

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg']     = $e->getMessage();
        }

        return $results;
    }
}
