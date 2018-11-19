<?php

use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'code',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required' => 'message.web.error.0001'
	 	),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'transaction_code',
	 	'rules' => '',
	 	'message' => array(
	 		'required' => 'message.web.error.0001'
	 	),
	 	'default' => null,
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
