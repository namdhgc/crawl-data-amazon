<?php

namespace App\Http\Validates;

use Config;
use Spr\Base\Response\Response;
use Spr\Base\Validates\Helper as ValidateHelper;
use App\Http\Models\Promotion as ModelPromotion;
use Lang;
class ValidatePromotion
{


	public function usePromtion ($data_out_put_get_param) {

		$validateBase = ValidateHelper::baseValidate($data_out_put_get_param);

		if($validateBase['meta']['success']) {

			$code = $validateBase['response']['promotion_code'];

			$validateBase = $this->validateCodeReadyUse($code);
		}

		return $validateBase;
	}

	public function validateCodeReadyUse ($code) {

		$ModelPromotion = new ModelPromotion();
		$data_promotion = $ModelPromotion->getDataByCode($code);
		$response = Response::response();

		if($data_promotion['meta']['success'] && COUNT($data_promotion['response']) > 0 ) {

			if($data_promotion['response'][0]->used_by != null || $data_promotion['response'][0]->expired_time <= strtotime(\Carbon\Carbon::now()->toDateTimeString()) ) {

				$response['meta']['success'] = false;
				$response['meta']['code']  	 = '0030';
				$response['meta']['msg'] 	 = ['Promotion' => Lang::get('message.web.error.0030')];
				$response['response'] 		 = [];
			}else {

				$response['response']['discount'] = $data_promotion['response'][0]->discount;
				$response['response']['id'] = $data_promotion['response'][0]->id;
				$response['response']['promotion_code'] = $code;
			}
		}else {
			$response['meta']['success'] = false;
			$response['meta']['code']  	 = '0030';
			$response['meta']['msg'] 	 = ['Promotion' => Lang::get('message.web.error.0030')];
			$response['response'] 		 = [];
		}

		return $response;
	}
}