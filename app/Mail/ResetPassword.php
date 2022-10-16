<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $pincode;


    public function __construct($pincode)
    {
        $this->pincode = $pincode;
    }


    public function build()
    {
        return $this->markdown('emails.auth.reset',['pincode' => $this->pincode]);
    }
}
