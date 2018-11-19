<?php
return [
		'form-action'	=> [
					'title'	=> 'Form add/edit data',
			],
		'price-list' => [

		    'title' 	=>	'Price List',

			'name'	=>	[
				'title'			=>	'Name',
				'help-block'	=>	"Enter name of price list."
			],
			'type'	=>	[
				'title'			=>	'Type',
				'default'		=>	'Default',
				'normal'		=>	'Normal',
				'help-block'	=>	"Enter type of price list."
			],

			'description'	=>	[
				'title'			=>	'Description',
				'help-block'	=>	"Enter name of price list."
			],

		],
		'price-list-detail' => [
			'title'	=> 'Price List Detail',
			'price_id'	=>	[
				'title'			=>	'Price List Name',
				'help-block'	=>	"Enter name of price list."
			],
			'key'	=>	[
				'title' 		=>	'Key',
				'help-block'	=>	"Enter Key of price list."
			],
			'value'	=>	[
				'title' 		=>	'Value',
				'help-block'	=>	"Enter Value of price list."
			]
		],
		'surcharge-price-list' => [

		    'title' 	=>	'Surcharge price List',

			'name'	=>	[
				'title'			=>	'Name',
				'help-block'	=>	"Enter name of surcharge price list."
			],
			'type'	=>	[
				'title'			=>	'Type',
				'help-block'	=>	"Enter type of surcharge price list."
			],

			'description'	=>	[
				'title'			=>	'Description',
				'help-block'	=>	"Enter name of surcharge price list."
			],
		],
		'surcharge-price-list-detail' => [
			'title'	=> 'Price List Detail',
			'price_id'	=>	[
				'title'			=>	'Surcharge price List Name',
				'help-block'	=>	"Enter name of surcharge price list."
			],
			'key'	=>	[
				'title' 		=>	'Key',
				'help-block'	=>	"Enter Key of price list."
			],
			'value'	=>	[
				'title' 		=>	'Value',
				'help-block'	=>	"Enter Value of price list."
			]
		],
];