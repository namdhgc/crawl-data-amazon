<?php
use Spr\Base\Config\Helper;


$dataParam = array(
 	array(
	 	'key' => 'roles_id',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => 10,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'data',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => 10,
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
