<?php

namespace App\Http\Controllers;

use Input;
use App\Http\Models\PaymentType as ModelPaymentType;
use Spr\Base\Response\Response;
use App\Http\Models\Transaction as ModelTransaction;
use Config;
/**
*
*/
class PaymentController extends Controller
{


	function __construct()
	{
		# code...
	}


	public function callback_payment_online ($data_output_validate_param) {

		if($data_output_validate_param['meta']['success']) {

			$code 			= $data_output_validate_param['response']['vnp_TxnRef'];
			$vnp_SecureHash = $data_output_validate_param['response']['vnp_SecureHash'];
			$vnp_BankTranNo = $data_output_validate_param['response']['vnp_BankTranNo'];
			$vnp_Amount 	= $data_output_validate_param['response']['vnp_Amount'];

			$ModelTransaction =   new ModelTransaction();
			$data_transaction = $ModelTransaction->getInformationTransactionByCode($code);
			if($data_transaction['meta']['success'] && COUNT($data_transaction['response']) > 0) {

				$price 		= $data_transaction['response']->paid_before;
				$total_price 		= $data_transaction['response']->total_amount;


				$vnpay_hash_secret = Config::get('spr.system.vnpay.vnp_HashSecret');
				$params = array();
		        foreach ($_GET as $key => $value) {
		            $params[$key] = $value;
		        }
		        unset($params['vnp_SecureHashType']);
		        unset($params['vnp_SecureHash']);
		        ksort($params);
		        $i = 0;
		        $hashData = "";
		        foreach ($params as $key => $value) {
		            if ($i == 1) {
		                $hashData = $hashData . '&' . $key . "=" . $value;
		            } else {
		                $hashData = $hashData . $key . "=" . $value;
		                $i = 1;
		            }
		        }

		        $secureHash = md5($vnpay_hash_secret . $hashData);

				if($price * 100 == (int)$vnp_Amount && $secureHash == $vnp_SecureHash) {

					$data_update = [

						'amount_paid' => $price,
						'amount_unpaid' => $total_price - $price,
						'vnp_BankTranNo' => $vnp_BankTranNo
					];

					$where =   [

	                    [

	                        'fields'    =>  'code',
	                        'operator'  =>  '=',
	                        'value'     =>  $code
	                    ]

	                ];

                	$data   =   $ModelTransaction->updateData($data_update,$where);
                	$data_output_validate_param['response'] = [
                		'code'	=> $code,
                		'phone_number'	=> $data_transaction['response']->ba_phone_number,
                	];
				}else {

					$data_output_validate_param['meta']['success'] = false;
				}

			}else {

				$data_output_validate_param['meta']['success'] = false;
			}
		}

		return $data_output_validate_param;
	}

}