<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RejectionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $rejectionReason;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rejectionReason)
    {
        $this->rejectionReason=$rejectionReason;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('rejectionMail');
    }
}
