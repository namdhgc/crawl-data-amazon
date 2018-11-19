<?php

namespace App\Http\Validates;

use Config;
use Spr\Base\Response\Response;
use Spr\Base\Validates\Helper as ValidateHelper;
use App\Http\Models\HappyCode as ModelHappyCode;
use Lang;
use Auth;

class ValidateHappyCode
{


	public function useHappyCode ($data_out_put_get_param) {

		$validateBase = ValidateHelper::baseValidate($data_out_put_get_param);

		if($validateBase['meta']['success']) {

			$code = $validateBase['response']['happy_code'];

			$validateBase = $this->validateCodeReadyUse($code);
		}

		return $validateBase;
	}

	public function validateCodeReadyUse ($code) {

		$ModelHappyCode 	= new ModelHappyCode();
		$data_happy_code 	= $ModelHappyCode->getDataByCode($code);
		$response 			= Response::response();

		if( Auth::user() != null ){

			if($data_happy_code['meta']['success'] && COUNT($data_happy_code['response']) > 0 ) {

				if($data_happy_code['response'][0]->used_by != Auth::user()->id || $data_happy_code['response'][0]->expired_time <= strtotime(\Carbon\Carbon::now()->toDateTimeString()) ) {

					$response['meta']['success'] = false;
					$response['meta']['code']  	 = '0030';
					$response['meta']['msg'] 	 = ['Happy code' => Lang::get('message.web.error.0030')];
					$response['response'] 		 = [];
				}else {

					$response['response']['discount'] 	= $data_happy_code['response'][0]->discount;
					$response['response']['id'] 		= $data_happy_code['response'][0]->id;
					$response['response']['happy_code'] = $code;
				}
			}else {
				$response['meta']['success'] = false;
				$response['meta']['code']  	 = '0030';
				$response['meta']['msg'] 	 = ['Happy code' => Lang::get('message.web.error.0030')];
				$response['response'] 		 = [];
			}

		} else {

			$response['meta']['success'] = false;
			$response['meta']['code']  	 = '0020';
			$response['meta']['msg'] 	 = ['Login' => Lang::get('message.web.error.0020')];
			$response['response'] 		 = [];
		}

		return $response;
	}
}