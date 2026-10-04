<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class NuevosMorososMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly Collection $morosos,
        public readonly string $fecha
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Nuevos morosos ANASCOR — {$this->fecha}",
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'emails.nuevos-morosos',
        );
    }
}
