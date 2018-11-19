<?php
use Spr\Base\Config\Helper;


$dataParam = array(

	array(
	 	'key' => 'image',
	 	'rules' => 'nullable | mimes:jpeg,png,jpg,gif,svg',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
	array(
	 	'key' => 'icon',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'company_name',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'email_support',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'hotline',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'total_products',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'transaction_success',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'description',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	)

);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;