<?php
use Spr\Base\Config\Helper;


$dataParam = array(

 	array(
	 	'key' => 'buyerFirstname',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required'	=>	'message.web.error.0001',
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'buyerLastname',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required'	=>	'message.web.error.0001',
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'buyerPhone',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required'	=>	'message.web.error.0001',
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'buyerEmail',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required'	=>	'message.web.error.0001',
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'buyerCityID',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required'	=>	'message.web.error.0001',
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'buyerAddress',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required'	=>	'message.web.error.0001',
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'buyerDistrictID',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required'	=>	'message.web.error.0001',
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'buyerWardID',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required'	=>	'message.web.error.0001',
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),

 	array(
	 	'key' => 'receiverFirstname',
	 	'rules' => '',
	 	'message' => array(
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'receiverLastname',
	 	'rules' => '',
	 	'message' => array(
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'receiverPhone',
	 	'rules' => '',
	 	'message' => array(
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'receiverEmail',
	 	'rules' => '',
	 	'message' => array(
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'receiverAddress',
	 	'rules' => '',
	 	'message' => array(
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'receiverCityID',
	 	'rules' => '',
	 	'message' => array(
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'receiverDistrictID',
	 	'rules' => '',
	 	'message' => array(
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'receiverWardID',
	 	'rules' => '',
	 	'message' => array(
	 		),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'create_new_acc',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => false,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'receiverInfo',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => false,
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;