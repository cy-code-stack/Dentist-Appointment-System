<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAddedVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $addMailData;

    /**
     * Create a new message instance.
     *
     * @param  array  $mailData
     * @return void
     */
    public function __construct($addMailData)
    {
        $this->addMailData = $addMailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Email Verification')
                    ->view('email.addmail') // Blade view file
                    ->with($this->addMailData); 
    }
}