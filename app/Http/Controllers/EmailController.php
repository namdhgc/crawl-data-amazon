<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\TransactionPasswordForNewUser;
use App\Mail\TransactionStatusMail;
use App\Mail\ResetPasswordMail;
use Config;
use Mail;

class EmailController extends Controller
{
	public function sendMail($type, $data, $to, $cc = null, $bcc = null)
    {
    	try {

    		$mail = Mail::to($to);

		    if (isset($cc) && $cc != '' && $cc != null) {

		    	$mail->cc($cc);
		    }

		    if (isset($bcc) && $bcc != '' && $bcc != null) {

		    	$mail->bcc($bcc);
		    }

		    if ($type == Config::get('spr.system.email_types.reset_password')) {

		    	$mail->send(new ResetPasswordMail($type, $data));
		    }

		    if ($type == Config::get('spr.system.email_types.transaction_status')) {

		    	$mail->send(new TransactionStatusMail($type, $data));
		    }

		    if ($type == Config::get('spr.system.email_types.transaction_password_for_new_user')) {

		    	$mail->send(new TransactionPasswordForNewUser($type, $data));
		    }

		    return true;

    	} catch (Exception $e) {

    		return false;
    	}
    }
}