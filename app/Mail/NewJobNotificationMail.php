<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewJobNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data, $sender, $subject ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $sender, $subject)
    {
        $this->data = $data;
        $this->sender = $sender;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('employer_emails.send_new_jobs_notification_message')
        ->from($this->sender)
        ->with('data', $this->data);
    }
}
