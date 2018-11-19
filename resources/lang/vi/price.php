<?php
return [
		'form-action'	=> [
					'title'	=> 'Form thêm/sửa',
			],
		'price-list' => [

		    'title' 	=>	'Danh sách giá tiền',

			'name'	=>	[
				'title'			=>	'Tên',
				'help-block'	=>	"Nhập tên của danh sách giá."
			],
			'type'	=>	[
				'title'			=>	'Loại',
				'default'		=>	'Mặc định',
				'normal'		=>	'Bình thường',
				'help-block'	=>	"Loại của danh sách giá."
			],

			'description'	=>	[
				'title'			=>	'Mô tả',
				'help-block'	=>	"Mô tả của danh sách giá."
			],

		],
		'price-list-detail' => [
			'title'	=> 'Price List Detail',
			'price_id'	=>	[
				'title'			=>	'Tên của danh sách giá',
				'help-block'	=>	"Nhập tên của danh sách giá."
			],
			'key'	=>	[
				'title' 		=>	'Từ khoá',
				'help-block'	=>	"Nhập từ khoá của danh sách giá."
			],
			'value'	=>	[
				'title' 		=>	'Giá trị',
				'help-block'	=>	"Nhập giá trị của danh sách giá."
			]
		],
		'surcharge-price-list' => [

		    'title' 	=>	'Bảng giá phụ thu',

			'name'	=>	[
				'title'			=>	'Tên',
				'help-block'	=>	"Nhập tên của bảng giá phụ thu."
			],
			'type'	=>	[
				'title'			=>	'Type',
				'help-block'	=>	"Nhập loại của bảng giá phụ thu."
			],

			'description'	=>	[
				'title'			=>	'Mô tả',
				'help-block'	=>	"Nhập mô tả của bảng giá phụ thu."
			],
		],
		'surcharge-price-list-detail' => [
			'title'	=> 'Chi tiết danh sách giá',
			'price_id'	=>	[
				'title'			=>	'Tên của bảng giá phụ thu',
				'help-block'	=>	"Nhập tên bảng giá phụ thu."
			],
			'key'	=>	[
				'title' 		=>	'Từ khoá',
				'help-block'	=>	"Nhập từ khoá của bảng giá phụ thu."
			],
			'value'	=>	[
				'title' 		=>	'Giá trị',
				'help-block'	=>	"Nhập giá trị của bảng giá."
			]
		],
];