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
	 	'key' => 'name',
	 	'rules' => 'required|min:3|max:75',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001.',
	 		'min'		=> 'message.web.error.0002.',
	 		'max'		=> 'message.web.error.0003.'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'remake',
	 	'rules' => 'max:150',
	 	'message' => array(
	 		'max'	=> 'message.web.error.0003.'
	 	),
	 	'default' => '',
		'htmlentities' => true
 	),
 	array(
	 	'key' => 'permission',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
