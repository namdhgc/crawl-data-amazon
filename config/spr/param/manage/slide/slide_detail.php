<?php
use Spr\Base\Config\Helper;

$dataParam = array(
	array(
	 	'key' => 'slide_id',
	 	'rules' => 'nullable|numeric',
	 	'message' => array(
	 		'numeric' => 'message.web.error.0004'
	 		),
	 	'default' => null,
		'htmlentities' => false
 	),
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
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
