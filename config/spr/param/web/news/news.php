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
	 	'key' => 'post_id',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;