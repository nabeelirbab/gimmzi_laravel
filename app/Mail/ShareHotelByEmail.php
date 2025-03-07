<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShareHotelByEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $mail_data;
    public $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_data, $email)
    {
        $this->mail_data = $mail_data;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Gimmzi Smart Rewards Travel & Tourism - Check out this hotel from -' . $this->mail_data['hotel_name'])
            ->markdown('emails.shareHotelMail')
            ->with(['mail_data' => $this->mail_data, 'email' => $this->email]);
    }
}
