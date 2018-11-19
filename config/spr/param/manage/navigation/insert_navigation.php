<?php
use Spr\Base\Config\Helper;


$dataParam = array(
 	array(
	 	'key' => 'title',
	 	'rules' => 'required | min:5 | max:50',
	 	'message' => array(
	 		'required' 	=>	'message.web.error.0001',
	 		'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'	
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'description',
	 	'rules' => 'min:5 | max:200',
	 	'message' => array(
			'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'	
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'image',
	 	'rules' => 'required | mimes:jpeg,png,jpg,gif,sv',
	 	'message' => array(
	 		'required' 	=>	'message.web.error.0001',
	 		'mimes'		=> 'message.web.error.0010'
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'lang_code',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required' 	=>	'message.web.error.0001',
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'link',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required' 	=>	'message.web.error.0001',
	 		),
	 	'default' => '',
		'htmlentities' => false
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
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;