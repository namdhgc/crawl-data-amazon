<?php
use Spr\Base\Config\Helper;


$dataParam = array(
	array(
	 	'key' => 'vnp_Amount',
	 	'rules' => 'required| numeric',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => true
 	),
 	array(
	 	'key' => 'vnp_BankCode',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => true
 	),
 	array(
	 	'key' => 'vnp_BankTranNo',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'vnp_CardType',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'vnp_OrderInfo',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '0',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'vnp_PayDate',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '0',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'vnp_ResponseCode',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '0',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'vnp_TmnCode',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '0',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'vnp_TransactionNo',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '0',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'vnp_TxnRef',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '0',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'vnp_SecureHashType',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '0',
		'htmlentities' => false
 	),
 	array(
	 	'key' => 'vnp_SecureHash',
	 	'rules' => 'required',
	 	'message' => array(),
	 	'default' => '0',
		'htmlentities' => false
 	)
);

$dataConfig = Helper::setDataConfig($dataParam);

return $dataConfig;