<?php
return [
		'form-action'	=> [
					'title'	=> 'Form add/edit data',
			],
		'form-delete'	=> [
					'title'	=>	'Form delete data.'
			],	
		'transaction' => [
			'title' 	=>	'Transaction List',
			'form-action'	=>	'VIEW / UPDATE TRANSACTION',

			'code' 		=>	[
				'name' 		 	=>	'Code'
			],

			'amazon_id' => [
				'name' 			=>	'Amazon ID',
				'help-block'	=>	'Enter Amazon code of Transaction'
			],

			'buyer_id' => [
				'name' 			=>	'Buyer ID',
				'value'			=>	'View History',
			],

			'receiver_id' => [
				'name' 			=>	'Receiver ID',
			],

			'purchased_price' => [
				'name' 			=>	'Purchased Price'
			],

			'purchased_date' => [
				'name' 			=>	'Purchased Date',
				'help-block'	=>	'Enter Purchased date of Transaction'
			],

			'voucher' => [
				'name' 			=>	'Voucher'
			],

			'payment' => [
				'name' 			=>	'Payment'
			],

			'comment' => [
				'name' 			=>	'Comments'
			],

			'status' => [
				'name' 			=>	'Status'
			],

			'created' => [
				'name' 			=>	'Created'
			],

			'first_name' => [
				'name' 			=>	'First name'
			],

			'last_name' => [
				'name' 			=>	'Last name'
			],

			'email' => [
				'name' 			=>	'Email'
			],

			'receiver_first_name' => [
				'name' 			=>	'Receiver first name'
			],

			'receiver_last_name' => [
				'name' 			=>	'Receiver last name'
			],

			'receiver_email' => [
				'name' 			=>	'Receiver email'
			]
		],
		'transaction-status' => [
			'title'	=> 'Transaction Status',
			'name'	=>	[
				'title'			=>	'Name',
				'help-block'	=>	"Enter name of transaction status."
			],
			'description'	=>	[
				'title' 		=>	'Description',
				'help-block'	=>	"Enter description of transaction status."
			]
		],
		'transaction-detail' => [
			'title' => 'Transaction Detail'
		],

		'transaction_information' => [
			'title' => 'Transaction information'
		],
		'buyer_information' => [
			'title' => 'Buyer information'
		],
		'receiver_information' => [
			'title' => 'Receiver information'
		]
];