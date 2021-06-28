<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailIndexApproved extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
	protected $data;

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
     * @return $this
     */
    public function build()
    {
       return $this->subject('Index Approved by PCN Admin')
            ->view('emails.createIndexAprroved')
            ->with($this->data);
    }
}
