<?php
use Spr\Base\Config\Helper;


$dataParam = array(
 	array(
	 	'key' => 'name',
	 	'rules' => 'required',
	 	'message' => array(

	 		'requỉed'	=> 'message.web.error.0001',
	 	),
	 	'default' => '',
		'htmlentities' => true
 	),
 	array(
	 	'key' => 'email',
	 	'rules' => 'required|email',
	 	'message' => array(
	 		'requỉed'	=> 'message.web.error.0001',
	 		'email'		=> 'message.web.error.0038',
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'description',
	 	'rules' => 'required',
	 	'message' => array(

	 		'requỉed'	=> 'message.web.error.0001',
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'phone_number',
	 	'rules' => 'required',
	 	'message' => array(

	 		'requỉed'	=> 'message.web.error.0001',
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'g-recaptcha-response',
	 	'rules' => 'required|recaptcha',
	 	'message' => array(
	 		'required'		=> 'message.web.error.0008',
	 		'recaptcha'		=> 'message.web.error.0008'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;