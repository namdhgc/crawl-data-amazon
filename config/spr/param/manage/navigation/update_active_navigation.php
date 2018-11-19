<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'id',
	 	'rules' => 'required | numeric',
	 	'message' => array(
	 		'required' 	=>	'message.web.error.0001',
	 		'numeric'	=>	'message.web.error.0004'
	 		),
	 	'default' => '',
		'htmlentities' => true
 	),
 	array(
	 	'key' => 'display',
	 	'rules' => 'nullable | numeric',
	 	'message' => array(
	 		'numeric'	=>	'message.web.error.0004'
	 		),
	 	'default' => '0',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'lang_code',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required' 	=>	'message.web.error.0001',
	 		),
	 	'default' => '0',
		'htmlentities' => false
 	),

);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;