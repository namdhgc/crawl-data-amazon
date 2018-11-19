<?php

namespace App\Http\Controllers\CustomerAuth;

use App\customer;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/customer';
	protected $guard = 'customer';
	
	public function showLoginForm()
	{
		if (Auth::guard('customer')->check())
		{
			return redirect('/customer');
		}
		
		return view('customer.auth.login');
	}
	
	public function showRegistrationForm()
	{
		return view('customer.auth.register');
	}
	
	public function resetPassword()
	{
		return view('customer.auth.passwords.email');
	}
	
	public function logout(){
		Auth::guard('customer')->logout();
		return redirect('/customer/login');
	}
}