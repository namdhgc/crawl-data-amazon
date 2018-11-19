<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;
use App\Http\Models\Customer;
use Input;
use Auth;
use Config;
use Redirect;
use Session;
use DB;
use Hash;

class RegisterCustomerController extends Controller
{

    protected $table = 'customer';

	// protected $redirectTo = 'your redirect path after registration';

    protected function create(array $data)
    {
        return Admin::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
        ]);
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }


   
}