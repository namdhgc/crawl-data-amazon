<?php

namespace App\Http\Validates;

use Config;
use Spr\Base\Response\Response;
use Spr\Base\Validates\Helper as ValidateHelper;
use Lang;

class ValidateProductCategories
{

	public function updateData ($data_output_get_param) {

		$validatebase = ValidateHelper::baseValidate($data_output_get_param);
		
		if($validatebase['meta']['success']) {

			$level = $validatebase['response']['level'];
			$icon  = $validatebase['response']['icon_update'];
			$background_image = $validatebase['response']['background_image_update'];

			if($level == 0 && ( $icon != '' || $background_image != '' ) ) {

				$messages = array(

					'mimes'		=> Lang::get('message.web.error.0010')
				);

				if($icon != '') {

					$param = array(
						'icon' => $icon
					);

					$rules = array(

						'icon' => 'mimes:jpeg,png,jpg,gif,svg'
					);
					
					$validate_icon = ValidateHelper::otherValidate($param, $rules, $messages);

					if(!$validate_icon['meta']['success']) {

						return $validate_icon;
					}
				}

				if($background_image != '') {

					$param = array(
						'background_image' => $background_image
					);

					$rules = array(

						'background_image' => 'mimes:jpeg,png,jpg,gif,svg'
					);
					
					$validate_background_image = ValidateHelper::otherValidate($param, $rules, $messages);

					if(!$validate_background_image['meta']['success']) {

						return $validate_background_image;
					}
				}
			}
		}

		return $validatebase;
	}

	
}