<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserVerified extends Mailable
{
    use SerializesModels;

    private $data;

    public function __construct($email)
    {
        $this->data = [
            'email' => $email,
        ];
    }

    public function build()
    {
        return $this->subject('Пользователь подтвердил свой адрес эл.почты на сайте ' . $_SERVER['SERVER_NAME'])
            ->view('site.mails.admin.user_verified', $this->data);
    }
}
