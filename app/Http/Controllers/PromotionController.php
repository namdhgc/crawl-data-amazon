<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Http\Models\Promotion as ModelPromotion;
use Config;
use Mail;
use Lang;
use Cache;

class PromotionController extends Controller
{


	public function addPromotionCodeToShoppingCart ($data_output_validate_param) {

		if($data_output_validate_param['meta']['success']){

			if( isset($_COOKIE['shopping_cart']) && (Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null && COUNT(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products']) > 0) ){

				$data_shopping_cart = Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']);
				$data_shopping_cart['promotion'] = [

					'code' => $data_output_validate_param['response']['promotion_code'],
					'discount' => $data_output_validate_param['response']['discount'],
				];

				Cache::forget('shopping_cart_'.$_COOKIE['shopping_cart']);
				Cache::forever('shopping_cart_'.$_COOKIE['shopping_cart'], $data_shopping_cart);
				unset($data_output_validate_param['response']['id']);
			}
			else{
				$data_output_validate_param['meta']['success'] 	= false;
				$data_output_validate_param['meta']['msg'] 		= ['shopping_cart' => Lang::get('mesage.web.error.0031')];
				$data_output_validate_param['meta']['code'] 	= 0031;
				$data_output_validate_param['response'] 		= [];

			}
		}
		return $data_output_validate_param;
	}
}