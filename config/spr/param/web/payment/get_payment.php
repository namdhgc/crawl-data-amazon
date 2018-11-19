<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	
 	array(
	 	'key' => 'order_code',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required' => 'message.web.error.0001'
	 	),
	 	'default' => null,
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;