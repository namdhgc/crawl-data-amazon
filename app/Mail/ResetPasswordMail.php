<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Config;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    private $type;
    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type, $data)
    {

        $this->type = $type;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $view = null;

        if ($this->type = Config::get('spr.system.email_types.reset_password')) {

            $view = $this->view('emails.reset_password');
        }

        return $view->with('data', $data);
    }
}
