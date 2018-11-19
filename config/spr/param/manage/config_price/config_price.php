<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' 			=> 'key',
	 	'rules' 		=> '',
	 	'message' 		=> array(),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	),
 	array(
	 	'key' 			=> 'value',
	 	'rules' 		=> '',
	 	'message' 		=> array(),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;