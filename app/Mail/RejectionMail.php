<?php

namespace App\Mail;

use App\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RejectionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $donation;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Donation $don)
    {
        $this->donation=$don;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('rejectionMail')
            ->with([
                'reason' => $this->donation->rejection_reason,

            ]);
    }
}
