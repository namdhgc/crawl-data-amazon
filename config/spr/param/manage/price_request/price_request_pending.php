<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'pending',
	 	'rules' => '',
	 	'message' => array(
	 		'numeric' => 'message.web.error.0004'
	 		),
	 	'default' => '',
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
