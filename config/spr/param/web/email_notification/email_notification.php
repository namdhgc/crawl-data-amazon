<?php 

use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'email',
	 	'rules' => 'email|max:200',
	 	'message' => array(
	 		'email'		=> 'message.web.error.00099',
	 		'max'		=> 'message.web.error.0003'
	 	),
	 	'default' => null,
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
