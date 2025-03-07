<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationSendToProviderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $details;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
        // dd($this->details);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Invitation to Join the Gimmzi Smart Community Portal';
        return $this->subject($subject)
                    ->markdown('emails.invitationSendToProviderMail')
                    ->with('details', $this->details);
    }
}
