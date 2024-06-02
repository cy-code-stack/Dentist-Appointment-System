<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookAppointmentVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $bookmailData;

    /**
     * Create a new message instance.
     *
     * @param  array  $mailData
     * @return void
     */
    public function __construct($bookmailData)
    {
        $this->bookmailData = $bookmailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Book Appointment Verification')
                    ->view('email.bookappointment') // Blade view file
                    ->with($this->bookmailData); 
    }
}