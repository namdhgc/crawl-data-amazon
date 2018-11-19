<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'page',
	 	'rules' => 'required | numeric',
	 	'message' => array(),
	 	'default' => '1',
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
