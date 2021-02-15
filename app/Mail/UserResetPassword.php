<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $random_token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($random_token)
    {
        $this->random_token = $random_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url('forgot-password/token='.$this->random_token);
        return $this->markdown('emails.reset-password', [
            'url'=>$url
        ]);
    }
}
