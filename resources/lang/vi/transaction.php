<?php
return [
		'form-action'	=> [
					'title'	=> 'Form thêm/sửa',
			],
		'form-info'		=>	[
					'title'	=> 'Form chi tiết'
		],		
		'form-delete'	=> [
					'title'	=>	'Form xoá.'
			],	
		'transaction' => [
			'title' 	=>	'Danh sách giao dịch',
			'form-action'	=>	'Xem/cập nhật giao dịch',

			'code' 		=>	[
				'name' 		 	=>	'Mã đơn hàng'
			],

			'amazon_id' => [
				'name' 			=>	'Amazon ID',
				'help-block'	=>	'Nhập mã amazon của giao dịch'
			],

			'status' => [
				'name' 			=>	'Tình trạng đơn hàng'
			],

			'total_amount' => [
				'name' 			=>	'Tổng cộng'
			],

			'amount_paid' => [
				'name' 			=>	'Tổng số tiền thanh toán'
			],

			'amount_unpaid' => [
				'name' 			=>	'Tổng số tiền chưa thanh toán'
			],

			'comment' => [
				'name' 			=>	'Ghi chú'
			],

			'total_price_product' => [
				'name' 			=>	'Giá trị đơn hàng tại amazon'
			],

			'total_fee_product' => [
				'name' 			=>	'Tổng phí của đơn hàng'
			],

			'cost_incurred' => [
				'name' 			=>	'Chi phí phát sinh'
			],

			'verify_transaction' => [
				'name' 			=>	'Xác nhận giao dịch'
			],

			'action' => [
				'name' 			=>	'Hành động'
			],

			'infor_buyer'	=>	[

				'full_name' => [
					'name' 			=>	'Họ Tên'
				],
				'email' => [
					'name' 			=>	'Email'
				],
				'phone_number' => [
					'name' 			=>	'Số điện thoại'
				],
				'address' => [
					'name' 			=>	'Địa chỉ'
				],
			],

			'info_receiver'	=>	[

				'full_name' => [
					'name' 			=>	'Họ Tên'
				],

				'email' => [
					'name' 			=>	'Email'
				],

				'phone_number' => [
					'name' 			=>	'Số điện thoại'
				],

				'address' => [
					'name' 			=>	'Địa chỉ'
				],

			]
			
		],
		'transaction-status' => [
			'title'	=> 'Trạng thái giao dịch',
			'name'	=>	[
				'title'			=>	'Tên',
				'help-block'	=>	"Nhập tên của trạng thái giao dịch."
			],
			'description'	=>	[
				'title' 		=>	'Mô tả',
				'help-block'	=>	"Nhập mô tả của trạng thái giao dịch."
			]
		],
		'transaction_detail' => [
			'title' => 'Chi tiết giao dịch'
		],

		'transaction_information' => [
			'title' => 'Thông tin giao dịch'
		],
		'buyer_information' => [
			'title' => 'Thông tin người mua'
		],
		'receiver_information' => [
			'title' => 'Thông tin người nhận'
		]
];