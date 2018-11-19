<?php
use Spr\Base\Config\Helper;


$dataParam = array(
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
	 	'default' => 10,
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
