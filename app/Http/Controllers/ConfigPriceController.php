<?php

namespace App\Http\Controllers;

use Input;
use Config;
use Spr\Base\Response\Response;
use App\Http\Models\ConfigPrice as ModelConfigPrice;

/**
*
*/
class ConfigPriceController extends Controller
{

	protected $table = "config_price";

	function __construct()
	{
		# code...
	}

	public function updateData($data_output_validate_param) {

		if ($data_output_validate_param['meta']['success']) {

			$where 		= [];

			$key 			= $data_output_validate_param['response']['key'];
			$value 			= $data_output_validate_param['response']['value'];

			$data = [
				'value'			=> $value
			];

			$where = [
				[
					'fields' 	=> 'key',
					'operator'	=> '=',
					'value'		=> $key
				]
			];

			if (isset($key) && $key != '') {

				// update data
				$results	= ModelConfigPrice::updateData($this->table, $data, $where);

				$data_output_validate_param['response']['data'] = $results;
				$data_output_validate_param['meta']['msg'] 		= ['Updated successfully.'];
			}
		}
		
		return $data_output_validate_param;
	}
}