<?php

use OAuth\Common\Storage\Session;

return [

	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => '\\OAuth\\Common\\Storage\\Session',
	// 'storage' => new Session(), 

	/**
	 * Consumers
	 */
	'consumers' => [

		'Facebook' => [
			'client_id'     => '273582869783773',   // MinhLe account
			'client_secret' => '4ca1fe4e4287481948c7b83db9bdb0bc', // Minh Le account
			'scope'         => ['public_profile'],

			// 'client_id' 		=> '1288272467965972', // namdh account
			// 'client_secret'		=> 'a9ccc91c053b5975eec7d99ff41c0804', //namdh account

			// all scope here https://developers.facebook.com/docs/facebook-login/permissions
			// app is not registered yet, cannot get full information of user
		],

		'Google' => [
		    'client_id'     => '814079201998-an58hsne2riefiiic0dsf1s48t3e4me1.apps.googleusercontent.com',
		    'client_secret' => 'F-aa5Ghgvj354-Veh2NSYLTu',
		    'scope'         => ['userinfo_email', 'userinfo_profile'],
		],

	]

];