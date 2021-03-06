<?php 

use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'email',
	 	'rules' => 'required|email',
	 	'message' => array(
	 		'required'	=> 'message.web.error.0001',
	 		'email'		=> 'message.web.error.0038'
	 	),
	 	'default' => null,
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
