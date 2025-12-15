<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Email;

class ResendMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Email $email) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->email->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: $this->email->html_body ?? $this->email->text_body,
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
