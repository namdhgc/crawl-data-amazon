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
	 	'key' => 'title',
	 	'rules' => 'required | min:3 | max:500',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'	
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'discount',
	 	'rules' => 'required | numeric | min:0 | max:100',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'numeric' 	=> 'message.web.error.0004',
	 		'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'	
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'expired_day',
	 	'rules' => 'required | numeric',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'numeric' 	=> 'message.web.error.0004'	
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'price',
	 	'rules' => 'numeric',
	 	'message' => array(
	 		'numeric' 	=> 'message.web.error.0004'	
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;