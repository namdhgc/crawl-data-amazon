<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	
 	array(
	 	'key' => 'key_search',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => true
 	),
 	array(
	 	'key' => 'sort',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'sort_type',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'limit',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => 30,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'from_date',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => 30,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'to_date',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => 30,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'status',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => 30,
		'htmlentities' => false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;