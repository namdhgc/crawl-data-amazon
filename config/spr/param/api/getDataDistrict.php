<?php
use Spr\Base\Config\Helper;


$dataParam = array(

	array(
	 	'key' => 'city_id',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required' => 'message.web.error.0001',
	 	),
	 	'default' => '',
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;