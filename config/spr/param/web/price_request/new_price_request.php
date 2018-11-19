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
	 	'key' => 'link',
	 	'rules' => 'required|max:2000',
	 	'message' => array(
	 		'required'	=> 'message.web.error.0001',
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'message',
	 	'rules' => 'max:500',
	 	'message' => array(
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'fullName',
	 	'rules' => 'required|max:200',
	 	'message' => array(
	 		'required'	=> 'message.web.error.0001',
			'max'		=> 'message.web.error.0003',
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'phone',
	 	'rules' => 'required|numeric|min:9',
	 	'message' => array(
	 		'required'	=> 'message.web.error.0001',
			'numeric' 	=> 'message.web.error.0004',
	 		'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'email',
	 	'rules' => 'required|max:200',
	 	'message' => array(
	 		'required'	=> 'message.web.error.0001',
			'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
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