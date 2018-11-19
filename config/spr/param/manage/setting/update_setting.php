<?php
use Spr\Base\Config\Helper;


$dataParam = array(

	array(
	 	'key' => 'id',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
	array(
	 	'key' => 'title',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'description',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'image',
	 	'rules' => 'nullable',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	)
 	,
 	array(
	 	'key' => 'icon',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	)
 	,
 	array(
	 	'key' => 'icon_class',
	 	'rules' => '',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	)


);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;