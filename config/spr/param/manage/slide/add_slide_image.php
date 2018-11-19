<?php
use Spr\Base\Config\Helper;


$dataParam = array(
 	array(
	 	'key' 			=> 'image',
	 	'rules' 		=> 'required|mimes:jpeg,png,jpg,gif,svg', // |mimes:jpeg,png,jpg,gif,svg
	 	'message' 		=> array(
	 		'required'	=> 'message.web.error.0001'
	 	),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	),
 	array(
	 	'key' 			=> 'lang_code',
	 	'rules' 		=> 'required', 
	 	'message' 		=> array(
	 		'required'	=> 'message.web.error.0001'
	 	),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	),
 	array(
	 	'key' 			=> 'slide_id',
	 	'rules' 		=> '', 
	 	'message' 		=> array(),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	),
 	array(
	 	'key' 			=> 'title',
	 	'rules' 		=> 'max:500', 
	 	'message' 		=> array(
	 		'max'		=> 'message.web.error.0003.'
	 	),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	),
 	array(
	 	'key' 			=> 'description',
	 	'rules' 		=> 'max:500', 
	 	'message' 		=> array(
	 		'max'		=> 'message.web.error.0003.'
	 	),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	),
 	array(
	 	'key' 			=> 'link',
	 	'rules' 		=> 'required|max:500', 
	 	'message' 		=> array(
	 		'required'	=> 'message.web.error.0001',
	 		'max'		=> 'message.web.error.0003.'
	 	),
	 	'default' 		=> '',
		'htmlentities' 	=> false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;