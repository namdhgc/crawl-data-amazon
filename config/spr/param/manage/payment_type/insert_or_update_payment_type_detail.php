<?php
use Spr\Base\Config\Helper;


$dataParam = array(
 	array(
	 	'key' => 'id',
	 	'rules' => 'numeric',
	 	'message' => array(
	 		'numeric' 	=> 'message.web.error.0004',
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'title',
	 	'rules' => 'required | min:3 | max:100',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'description',
	 	'rules' => 'required | min:3 | max:300',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'min'		=> 'message.web.error.0002',
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'payment_value',
	 	'rules' => 'required | numeric | max:100',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'numeric' 	=> 'message.web.error.0004',
	 		'max'		=> 'message.web.error.0029'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'type',
	 	'rules' => 'required | numeric',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 		'numeric' 	=> 'message.web.error.0004'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'cost_incurred',
	 	'rules' => 'numeric | max:100',
	 	'message' => array(
	 		'numeric' 	=> 'message.web.error.0004',
	 		'max'		=> 'message.web.error.0029'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'specified_value',
	 	'rules' => 'numeric',
	 	'message' => array(
	 		'numeric' 	=> 'message.web.error.0004',
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'bonus',
	 	'rules' => 'numeric',
	 	'message' => array(
	 		'numeric' 	=> 'message.web.error.0004'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'payment_type_id',
	 	'rules' => 'numeric',
	 	'message' => array(
	 		'numeric' 	=> 'message.web.error.0004'
	 	),
	 	'default' => '',
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
