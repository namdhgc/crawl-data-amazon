<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' 			=> 'id',
	 	'rules' 		=> '',
	 	'message' 		=> array(),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	),
 	array(
	 	'key' 			=> 'lang_code',
	 	'rules' 		=> '',
	 	'message' 		=> array(),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
