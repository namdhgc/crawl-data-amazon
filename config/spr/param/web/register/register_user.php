<?php 

use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'id',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'username',
	 	'rules' => 'required|max:100|min:3|unique:customers',
	 	'message' => array(
	 		'requỉed'	=> 'message.web.error.0001',
	 		'max'		=> 'message.web.error.0003',
	 		'min'		=> 'message.web.error.0002',
	 		'unique'	=> 'message.web.error.0039'
	 	),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'password',
	 	'rules' => 'required|max:100|min:5',
	 	'message' => array(
	 		'requỉed'	=> 'message.web.error.0001',
	 		'max'		=> 'message.web.error.0003',
	 		'min'		=> 'message.web.error.0002'
	 	),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'retypePassword',
	 	'rules' => 'required|max:100|min:5',
	 	'message' => array(
	 		'requỉed'	=> 'message.web.error.0001',
	 		'max'		=> 'message.web.error.0003',
	 		'min'		=> 'message.web.error.0002'
	 	),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'first_name',
	 	'rules' => 'required|max:100',
	 	'message' => array(
	 		'requỉed'	=> 'message.web.error.0001', 
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'last_name',
	 	'rules' => 'max:100',
	 	'message' => array(
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'email',
	 	'rules' => 'required|email|max:100|unique:customers',
	 	'message' => array(
	 		'requỉed'	=> 'message.web.error.0001',
	 		'email'		=> 'message.web.error.0038',
	 		'max'		=> 'message.web.error.0003',
	 		'unique'	=> 'message.web.error.0040'
	 	),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'phone_number',
	 	'rules' => 'max:20|unique:customers',
	 	'message' => array(
	 		'max'		=> 'message.web.error.0003',
	 		'unique'	=> 'message.web.error.0041'
	 	),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'facebook_id',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'google_id',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'g-recaptcha-response',
	 	'rules' => 'required|recaptcha',
	 	'message' => array(
	 		'required'		=> 'message.web.error.0001',
	 		'recaptcha'		=> 'message.web.error.0008'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
