<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $userData;
    public function __construct($userData)
    {
        $this->userData = $userData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bem vindo ao sistema de Gestão de Tarefas',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email.welcome',
        );
    }
    public function attachments(): array
    {
        return [];
    }
}
