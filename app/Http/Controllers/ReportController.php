<?php

namespace App\Http\Controllers;

use App\Http\Models\Bank as ModelBank;
use Config;
use Input;
use Auth;
use Cache;


/**
* 
*/
class ReportController extends Controller
{

	
	function __construct()
	{
		# code...
	}

    public function insertUpdateData($data_output_validate_param) {

        // dd($data_output_validate_param);

        if ($data_output_validate_param['meta']['success']) {

           
        }

        return $data_output_validate_param;
    }

}