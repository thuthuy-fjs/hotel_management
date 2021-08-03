<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
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
        $url = url('admin/forgot_password/token='.$this->random_token);
        return $this->subject('Đặt lại mật khẩu admin')->markdown('emails.reset-password', [
            'url'=>$url
        ]);
    }
}
