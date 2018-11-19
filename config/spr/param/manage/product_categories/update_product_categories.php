<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'id',
	 	'rules' => 'nullable|numeric',
	 	'message' => array(
	 		'numeric' => 'message.web.error.0004'
	 		),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'amazon_id',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'name',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'parent_id',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => null,
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
