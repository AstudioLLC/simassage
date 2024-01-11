<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return ResetPassword
     */
    public function build()
    {
        return $this->subject('Сообщение от ' . $_SERVER['SERVER_NAME'])
            ->view('site.mails.password_reset', $this->data)
            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'));
        //return $this->view('view.name');
    }
}
