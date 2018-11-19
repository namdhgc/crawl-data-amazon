<?php
	return [

		'web'	=> [

			'error' => [
				'0001' => 'Fields is required',
				'0002' => 'Length of data is too short',
				'0003' => 'Length of data is too long',
				'0004' => 'This field must be number',
				'0005' => 'This field must be date',
				'0006' => "Can't update Categories, Please contact admin!",
				'0007' => "Can't update Roles Permisison, Please contact admin!",
				'0008' => "Recaptcha is not valid",
				'0009' => "The image must be a file of type: jpeg, png, jpg, gif, svg.",
				'0010' => "This must be an image.",
				'0011' => "This record not exist.",
				'0012' => "Enough activated Navigation.",
				'0013' => "Status not exist.",
				'0014' => "Password and Password Retype is not match.",
				'0015' => "Username does not exists or token_reset_password wrong.",
				'0016' => "Login email not found.",
				'0017' => "Add row fail.please check again!.",
				'0018' => "Update row fail.please check again!.",
				'0019' => "Delete row fail.please check again!.",
				'0020' => "Please login to do this.",
				'0021' => "This product has been existed in your favorite list.",
				'0022' => "The size remaining not enought.",
				'0023' => "Updated image fail.",
				'0024' => "Inserted image fail.",
				'0025' => "Old password not match.",
				'0026' => "Please fill all field!",
				'0027' => "Price list defaul existed !.",
				'0028' => "Cannot add product to shopping cart, please try again.",
				'0029' => "Value is out of range.",

			],
			'success' => [
				'0001' => "Update row successful.",
				'0002' => "Add new row successful.",
				'0003' => "Successful.",
				'0004' => "Delete row successful.",
				'0005' => "This product was added to your favorite list successful.",
				'0006' => "Add product to shopping cart success.",
				'0007' => "Update product to shopping cart success.",
				'0008' => "Remove product to shopping cart success.",
			]
		],
		'api'	=> [
			'error' => [
				'0001'	=> 'This request has been taken by other. Plesase choose other request.',
				'0002'	=> 'Upload image fail. Plesase try again.',
				'0003'	=> 'Exists Slide has been activated.',
				'0004'	=> 'Updated  successful.',
				'0005'	=> 'Record not found.',
			],

			'success' => [
				'0001'	=> 'This request has not been taken, grant to you at this moment.',
			]
		],
		'verify'	=>	[
			'0'	=>	'Not verify yet.',
			'1'	=>	'Verified.'	
		]
		,
		'confirm'	=>	[
			'delete'	=>	'Are you sure you want to delete it ?',
		],	
	]; 
?>