<?php
use Spr\Base\Config\Helper;


$dataParam = array(
 	array(
	 	'key' => 'payment_type',
	 	'rules' => 'required',
	 	'message' => array(
			'required' => 'message.web.error.0001'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'happy_code_type',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required' => 'message.web.error.0001'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;