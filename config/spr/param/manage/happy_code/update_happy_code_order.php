<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	
	array(
	 	'key' => 'happy_code_order_id',
	 	'rules' => 'nullable | numeric',
	 	'message' => array(
	 		'numeric' 	=> 'message.web.error.0004',
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'status',
	 	'rules' => 'numeric',
	 	'message' => array(
	 		'numeric' 	=> 'message.web.error.0004'	
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'amount',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'happy_code_type',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;