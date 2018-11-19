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
	 	'key' => 'slide_id',
	 	'rules' => 'nullable | numeric',
	 	'message' => array(
	 		'numeric' 	=> 'message.web.error.0004',
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'title',
	 	'rules' => 'required | max:500',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'max'		=> 'message.web.error.0003'
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'link',
	 	'rules' => 'required | max:500',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'max'		=> 'message.web.error.0003'
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'image',
	 	'rules' => 'nullable | mimes:jpeg,png,jpg,gif,svg',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'mimes'		=> 'message.web.error.0009'
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'media_id',
	 	'rules' => 'nullable | numeric',
	 	'message' => array(
	 		'numeric' 	=> 'message.web.error.0004',
	 		'mimes'		=> ''
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;