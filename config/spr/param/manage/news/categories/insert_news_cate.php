<?php
use Spr\Base\Config\Helper;


$dataParam = array(
 	array(
	 	'key' => 'name',
	 	'rules' => 'required|min:3|max:75',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'lang_code',
	 	'rules' => 'required',
	 	'message' => array(
	 		'numeric'	=> 'message.web.error.0001'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'description',
	 	'rules' => 'nullable | max:200',
	 	'message' => array(
	 		'numeric'	=> 'message.web.error.0001',
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
