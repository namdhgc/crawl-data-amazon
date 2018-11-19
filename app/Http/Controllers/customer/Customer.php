<?php

namespace App\Http\Controllers\customer;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Auth;
use App\customer;

class Customer extends Controller
{
	public function __construct(){
        $this->middleware('customer');
   }
	
	public function index(){
		return view('customer.home');
    }
}