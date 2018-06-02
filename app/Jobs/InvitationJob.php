<?php

namespace App\Jobs;

use App\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class InvitationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $invitation;

    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function handle()
    {
        Mail::send("invitationMail", ['invitation' => $this->invitation], function (Message $mail) {
            $mail->from('invitations@codespace.ro');
            $mail->sender('invitations@codespace.ro');
            $mail->to($this->invitation->email);
            $mail->subject('Come join us. BloodDonations Management system');
        });
    }
}
