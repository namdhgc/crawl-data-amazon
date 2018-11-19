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
	 	'key' 			=> 'name',
	 	'rules' 		=> 'required|min:3|max:200',
	 	'message' 		=> array(
	 		'required' 	=> 'message.web.error.0001.',
	 		'min'		=> 'message.web.error.0002.',
	 		'max'		=> 'message.web.error.0003.'
	 	),
	 	'default'		=> '',
		'htmlentities'	=> false
 	),
 	array(
	 	'key' 			=> 'agency_id',
	 	'rules' 		=> 'required|numeric',
	 	'message' 		=> array(
	 		'required' 	=> 'message.web.error.0001.',
	 		'numeric' 	=> 'message.web.error.0004.'
	 	),
	 	'default'		=> '',
		'htmlentities'	=> false
 	),
 	array(
	 	'key' 			=> 'phone_number',
	 	'rules' 		=> 'required|max:20',
	 	'message' 		=> array(
	 		'required' 	=> 'message.web.error.0001.',
	 		'max'		=> 'message.web.error.0003.'
	 	),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	),
 	array(
	 	'key' 			=> 'address',
	 	'rules' 		=> 'required|max:200',
	 	'message' 		=> array(
	 		'required' 	=> 'message.web.error.0001.',
	 		'max'		=> 'message.web.error.0003.'
	 	),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	),
 	array(
	 	'key' 			=> 'country',
	 	'rules' 		=> 'required|max:200',
	 	'message' 		=> array(
	 		'required' 	=> 'message.web.error.0001.',
	 		'max'		=> 'message.web.error.0003.'
	 	),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	),
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;
