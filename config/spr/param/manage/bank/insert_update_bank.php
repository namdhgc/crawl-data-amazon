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
	 	'rules' => 'required | min:3 | max:200',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'agency',
	 	'rules' => 'required | min:3 | max:200',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'account_number',
	 	'rules' => 'required | max:20',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'max'		=> 'message.web.error.0003'
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'account_holder',
	 	'rules' => 'required | max:50',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'max'		=> 'message.web.error.0003'
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'description',
	 	'rules' => 'max:500',
	 	'message' => array(
	 		'max' 	=> 'message.web.error.0003'
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;