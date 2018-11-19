<?php

namespace App\Http\Validates;

use Config;
use Spr\Base\Response\Response;
use Spr\Base\Validates\Helper as ValidateHelper;
use App\Http\Models\Transaction as ModelTransaction;
use Lang;
class validateConfirmPayment
{

	public function validateGetConfirmPayment ($data_output_get_param) {

		$validatebase = ValidateHelper::baseValidate($data_output_get_param);
		
		if($validatebase['meta']['success']) {

			$order_code = $validatebase['response']['order_code'];

			$ModelTransaction = new ModelTransaction();
			$dataTransaction = $ModelTransaction->getDataByCode($order_code);

			if($dataTransaction['meta']['success'] && COUNT($dataTransaction['response']) > 0) {

				if($dataTransaction['response'][0]->status == Config::get('spr.system.status.payment.pay_the_entire')) {

					$validatebase['meta']['success'] = false;
					$validatebase['meta']['code'] 	 = '0033';
					$validatebase['meta']['msg'] 	 = ['Transaction' => Lang::get('message.web.error.0033')];
					$validatebase['response']        = [];
				}
			}else {

				$validatebase['meta']['success'] = false;
				$validatebase['meta']['code'] 	 = '0032';
				$validatebase['meta']['msg'] 	 = ['Transaction' => Lang::get('message.web.error.0032')];
				$validatebase['response']        = [];
			}
		}

		return $validatebase;
	}
}