<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class registrationapproval extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'bhutan@batcave.io';
		$name = 'Tashi Wangchuk';
		$subject = 'Bhutan Mail Found';
		$key = "Tashi";
		$value = "Ritzy";

			return $this->from($address, $name)
						->cc($address, $name)
						->bcc($address, $name)
						->replyTo($address, $name)
						->subject($subject)
						->with($key, $value);
    }
}
