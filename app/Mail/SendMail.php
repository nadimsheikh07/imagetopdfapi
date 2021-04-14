<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $subjectText;
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $subjectText, $body)
    {
        $this->email = $email;
        $this->subjectText = $subjectText;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email)->from(env('MAIL_USERNAME'))
            ->subject($this->subjectText)
            ->html($this->body);
            // ->view("mail/sendMail")
            // ->with([
            //     'subject' => $this->subjectText,
            //     'body' => $this->body,
            // ]);
    }
}
