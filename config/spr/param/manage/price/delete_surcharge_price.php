<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' 			=> 'id',
	 	'rules' 		=> 'required | numeric',
	 	'message' 		=> array(),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;