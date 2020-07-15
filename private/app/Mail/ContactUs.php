<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
		 
         $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
		
        return $this->from($this->content['email'])
            ->subject($this->content['subject'])
            ->markdown('emails.contact')
            ->with('content', $this->content);
			
       // return $this->markdown('emails.contact')->with('content', $this->content);
    }
}
