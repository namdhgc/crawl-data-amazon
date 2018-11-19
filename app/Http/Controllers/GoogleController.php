<?php

namespace App\Http\Controllers;

use \Illuminate\Session\Middleware\StartSession;
use App\Http\Models\Customer as ModelCustomer;
use Spr\Base\Response\Response;
use Illuminate\Http\Request;
use Auth;
use Lang;
use Url;
use Hash;

class GoogleController extends Controller
{

    public function loginWithGoogle(Request $request)
    {

        $code           = $request->get('code');
        $googleService  = \OAuth::consumer('Google', route('web-get-login-google-callback'));

        // check if code is valid

        // if code is provided get user data and sign in
        if ( ! is_null($code))
        {

        }
        // if not ask for permission first
        else
        {
            // get googleService authorization
            $url = $googleService->getAuthorizationUri();

            // return to google login url
            return redirect((string)$url);
        }
    }

    public function callbackGoogle(Request $request) {

        $code           = $request->get('code');
        $googleService  = \OAuth::consumer('Google');

        if ( ! is_null($code))
        {
            // This was a callback request from google, get the token
            $token = $googleService->requestAccessToken($code);

            // Send a request with it
            $user = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);

            $table          = 'customers';
            $first_name     = $user['family_name'];
            $last_name      = $user['given_name'];
            $google_id      = $user['id'];
            $username       = $user['email'];
            $email          = $user['email'];
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
                    'first_name'    => $first_name,
                    'last_name'     => $last_name,
                    'google_id'     => $google_id,
                    'email'         => $email,
                    'roles'         => $roles,
                    'password'      => Hash::make(bin2hex(random_bytes(4))),
                    'created_at'    => $created_at
                ];

                $inserted_id = ModelCustomer::insertData($data, $where)['response'];
            }

            $where = [
                [
                    'fields'    => 'google_id',
                    'operator'  => '=',
                    'value'     => $google_id
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