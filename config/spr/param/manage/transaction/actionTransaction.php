<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'id',
	 	'rules' => 'required | numeric',
	 	'message' => array(
	 		'numeric' => 'message.web.error.0004',
	 		'required' => 'message.web.error.0001'
	 		),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'amazon_id',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'expected_date',
	 	'rules' => 'nullable|date',
	 	'message' => array(
	 		'date' => 'message.web.error.0005'
	 		),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'status',
	 	'rules' => 'numeric',
	 	'message' => array(
	 		'numeric' => 'message.web.error.0004'
	 		),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'payment',
	 	'rules' => 'numeric',
	 	'message' => array(
	 		'numeric' => 'message.web.error.0004'
	 		),
	 	'default' => 0,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'real_price',
	 	'rules' => 'numeric',
	 	'message' => array(
	 		'numeric' => 'message.web.error.0004'
	 	),
	 	'default' => 0,
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
