<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'id',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'username',
	 	'rules' => 'required | min:3 | max:75',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'password',
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
	 	'key' => 'roles',
	 	'rules' => 'required | numeric',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'numeric' 	=> 'message.web.error.0004',
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'email',
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
	 	'key' => 'first_name',
	 	'rules' => 'required | max:100',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'last_name',
	 	'rules' => 'required | max:100',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'phone_number',
	 	'rules' => 'required | min:3 | max:20',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'address',
	 	'rules' => 'required | min:3 | max:500',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;