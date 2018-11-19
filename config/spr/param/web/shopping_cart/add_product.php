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
	 	'key' => 'quantity',
	 	'rules' => 'required|numeric',
	 	'message' => array(
	 		'required' => 'message.web.error.0001',
	 		'numeric' => 'message.web.error.0004',
	 	),
	 	'default' => 0,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'name',
	 	'rules' => '',
	 	'message' => array(
	 	),
	 	'default' => '',
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
