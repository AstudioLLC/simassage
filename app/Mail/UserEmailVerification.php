<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserEmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    private $data;

    /**
     * Create a new message instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Сообщение от ' . $_SERVER['SERVER_NAME'])
            ->view('site.mails.password_reset', $this->data)
            ->from('harutyunyangor1989@gmail.com', 'harutyunyangor1989@gmail.com');
            //->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_ADDRESS'));

        //return $this->view('view.name');
    }
}
