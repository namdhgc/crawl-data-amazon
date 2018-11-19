<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	
	array(
	 	'key' => 'id',
	 	'rules' => 'required | numeric',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => true
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;