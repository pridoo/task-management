<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReplyToMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $replyBody;

    public function __construct($replyBody)
    {
        $this->replyBody = $replyBody;
    }

    public function build()
    {
        return $this->subject('Reply from Admin')
                    ->view('emails.reply')
                    ->with(['replyBody' => $this->replyBody]);
    }
}

