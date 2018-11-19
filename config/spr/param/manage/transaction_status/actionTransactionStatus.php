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
	 	'message' => array(
	 		'required' => 'message.web.error.0001',
	 		'min' => 'message.web.error.0002',
	 		'max' => 'message.web.error.0003',
	 		),
	 	'default' => null,
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'description',
	 	'rules' => 'nullable|max:100',
	 	'message' => array(
			'max' => 'message.web.error.0003'
	 		),
	 	'default' => null,
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
