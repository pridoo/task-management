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
    public $recipientName;

    public function __construct($replyBody, $recipientName)
    {
        $this->replyBody = $replyBody;
        $this->recipientName = $recipientName;
    }

    public function build()
    {
        return $this->subject('Reply from Admin')
                    ->view('emails.reply')
                    ->with([
                        'replyBody' => $this->replyBody,
                        'recipientName' => $this->recipientName,
                    ]);
    }
}

