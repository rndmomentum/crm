<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $name, $email;

    // public $data;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function build()
    {
        $address = 'noreply@momentuminternet.my';
        $subject = 'This is a demo!';
        $name = $this->name;
        $test = 'cuba test';

        return $this->view('test')
                    ->from($address, $name)
                    ->cc($address, $name)
                    ->bcc($address, $name)
                    ->replyTo($address, $name)
                    ->subject($subject)
                    ->with([ 'test_message' => $test, 'name' => $this->name ]);
    }
}
