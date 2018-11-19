<?php

namespace App\Http\Controllers;

use Input;
use App\Http\Controllers\TransactionController;
use App\Http\Models\OrderTracking as ModelOrderTracking;
use Spr\Base\Response\Response;


/**
*
*/
class OrderTrackingController extends Controller
{

	protected $table = "";

	function __construct()
	{
		# code...
	}

	public function getData($data_output_validate_param) {

		if ($data_output_validate_param['meta']['success']) {
			
			$sort           = $data_output_validate_param['response']['sort'];
	        $limit          = $data_output_validate_param['response']['limit'];
	        $sort_type      = $data_output_validate_param['response']['sort_type'];
	        $key_search     = $data_output_validate_param['response']['key_search'];


	        $ModelOrderTracking = new ModelOrderTracking();

	        $data = $ModelOrderTracking->selectData($key_search,$limit, $sort, $sort_type);

	        $data_output_validate_param = $data;
        }

	        // dd($data_output_validate_param['response']);

        return $data_output_validate_param;
	}

	public function getOrderTrackingDetail($data_output_validate_param) {

		if ($data_output_validate_param['meta']['success']) {

			$code 						= $data_output_validate_param['response']['code'];
			$phone_number 				= $data_output_validate_param['response']['phone_number'];

			$TransactionController 		= new TransactionController();
			// dd($code . '===='./ss$phone_number);
			$data_output_validate_param['response'] 	=	$TransactionController->orderCheckingDetail($code,$phone_number)['response'];	
		}

		// dd($data_output_validate_param);

		return $data_output_validate_param['response'];
	}
}