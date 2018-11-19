<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	
	array(
	 	'key' => 'code',
	 	'rules' => 'numeric',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'city_id',
	 	'rules' => 'numeric',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'name',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'home_payment',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'free_shipping',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => 30,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'focus',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => 30,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'rural',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => 30,
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;