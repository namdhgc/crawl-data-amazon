<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'lang_code',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => 'vi',
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;