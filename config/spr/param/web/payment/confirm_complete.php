<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'transaction_code',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => true
 	),
 	array(
	 	'key' => 'payment_type_detail',
	 	'rules' => 'required | numeric',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => true
 	),
 	array(
	 	'key' => 'payment',
	 	'rules' => 'required | numeric',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'payment_method',
	 	'rules' => 'required | numeric',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'cost_incurred',
	 	'rules' => 'nullable | numeric',
	 	'message' => array(),
	 	'default' => '0',
		'htmlentities' => false
 	)
 	,
 	array(
	 	'key' => 'cost_incurred',
	 	'rules' => 'nullable | numeric',
	 	'message' => array(),
	 	'default' => '0',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'solution_payment',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'bankID',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => null,
		'htmlentities' => false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;