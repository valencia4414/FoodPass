<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $code,
        public string $userName = 'Administrador'
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Código de verificación de administrador — FoodPass',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-otp',
        );
    }
}