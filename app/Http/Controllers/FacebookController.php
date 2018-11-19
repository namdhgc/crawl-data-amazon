<?php

namespace App\Http\Controllers;

use \Illuminate\Session\Middleware\StartSession;
use App\Http\Models\Customer as ModelCustomer;
use Spr\Base\Response\Response;
use Illuminate\Http\Request;
use Auth;
use Lang;
use Hash;
use Config;

class FacebookController extends Controller
{
    public function loginWithFacebook(Request $request)
    {
        // get data from request
        $code = $request->get('code');
        
        // get facebook service
        $fbService = \OAuth::consumer('Facebook', route('web-get-login-facebook-callback'));
        
        // check if code is valid
        
        // if code is provided get user data and sign in
        if ( ! is_null($code))
        {
            // This was a callback request from facebook, get the token
            $token = $fbService->requestAccessToken($code);
            
            // Send a request with it
            $result = json_decode($fbService->request('/me'), true);
            
            $message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
            echo $message. "<br/>";
            
            //Var_dump
            //display whole array.
            dd($result);
        }
        // if not ask for permission first
        else
        {
            // get facebook authorization
            $url = $fbService->getAuthorizationUri();
            
            // return to facebook login url
            return redirect((string)$url);
        }
    }

    public function callbackFacebook(Request $request) {

        $code           = $request->get('code');
        $fbService      = \OAuth::consumer('Facebook');

        if ( ! is_null($code))
        {
            // This was a callback request from facebook, get the token
            $token = $fbService->requestAccessToken($code);

            // Send a request with it
            $user = json_decode($fbService->request('/me'), true);

            $table          = 'customers';
            $facebook_id    = $user['id'];
            $username       = $user['name'];
            $email          = 'xxxx'; // app is not registered yet, cannot get full information of user
            $roles          = Config::get('spr.system.roles.customer.id');
            $created_at     = strtotime(\Carbon\Carbon::now()->toDateTimeString());

            $where          = [];
            $ModelCustomer  = new ModelCustomer();
            $check          = $ModelCustomer->checkExistsUser($username);

            if ($check['response'] != null) {

                // user existed

            } else {

                $data = [
                    'username'      => $username,
                    'facebook_id'   => $facebook_id,
                    'email'         => $email,
                    'roles'         => $roles,
                    'password'      => Hash::make(bin2hex(random_bytes(4))),
                    'created_at'    => $created_at
                ];

                $inserted_id = ModelCustomer::insertData($data, $where)['response'];
            }

            $where = [
                [
                    'fields'    => 'facebook_id',
                    'operator'  => '=',
                    'value'     => $facebook_id
                ]
            ];

            $user_id = $ModelCustomer->selectData($table, $where)['response'][0]->id;

            Auth::guard('customer')->loginUsingId($user_id);

            $results['meta']['code']       = 200;
            $results['meta']['success']    = true;
            $results['meta']['msg']        = Lang::get('message.web.success.0003');

        }

        return $results;
    }
}