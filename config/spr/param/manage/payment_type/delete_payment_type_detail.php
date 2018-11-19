<?php
use Spr\Base\Config\Helper;


$dataParam = array(
 	array(
	 	'key' => 'id',
	 	'rules' => 'required | numeric',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
			'numeric' 	=> 'message.web.error.0004',
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
