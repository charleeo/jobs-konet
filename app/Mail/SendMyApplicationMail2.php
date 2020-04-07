<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMyApplicationMail2 extends Mailable
{
    use Queueable, SerializesModels;
    public $data,  $sender, $subject, $attachment, $attachment2;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $sender, $subject, $attachment)
    {
        $this->data = $data;
        $this->sender = $sender;
        $this->subject = $subject;
        $this->attachment = $attachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->from($this->sender)->subject($this->subject)->markdown('application_email.send_my_application')->with('data',$this->data)->attach();
        $message =  $this->markdown('application_email.send_my_application')
        ->from($this->sender)
        ->with('data', $this->data)
        ->attach($this->attachment)
        ->attach($this->attachment2);
        return $message;
    }
}

