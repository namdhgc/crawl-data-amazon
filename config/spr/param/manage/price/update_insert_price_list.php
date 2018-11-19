<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'id',
	 	'rules' => 'nullable|numeric',
	 	'message' => array(
	 		'numeric' => 'message.web.error.0004'
	 		),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'name',
	 	'rules' => 'required|min:5|max:50',
	 	'message' => array(),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'type',
	 	'rules' => 'required|numeric',
	 	'message' => array(
			'numeric' => 'message.web.error.0004',
			'required' => 'message.web.error.0001'
	 		),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'description',
	 	'rules' => 'nullable|max:100',
	 	'message' => array(),
	 	'default' => null,
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;