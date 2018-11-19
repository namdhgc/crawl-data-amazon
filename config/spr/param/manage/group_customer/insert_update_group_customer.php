<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	
	array(
	 	'key' => 'id',
	 	'rules' => 'nullable | numeric',
	 	'message' => array(
	 		'numeric' 	=> 'message.web.error.0004',
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'name',
	 	'rules' => 'required | min:3 | max:100',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'price_list_id',
	 	'rules' => 'required | numeric',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'numeric' 	=> 'message.web.error.0004'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'payment_type_id',
	 	'rules' => 'required | numeric',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'numeric' 	=> 'message.web.error.0004'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;