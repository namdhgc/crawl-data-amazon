<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'id',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'title',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 	),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'icon_update',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' =>'',
	 	'save'  => true,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'background_image_update',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' =>'',
	 	'save'  => true,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'level',
	 	'rules' => 'required',
	 	'message' => array(
	 		'required' 	=> 'message.web.error.0001',
	 	),
	 	'default' => 30,
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;