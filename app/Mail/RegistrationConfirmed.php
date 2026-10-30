<?php

namespace App\Mail;

use App\Models\ConcertRegistration;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class RegistrationConfirmed extends Mailable
{
    public function __construct(public ConcertRegistration $registration) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Successful '.config('concert.name').' Ticket Registration',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.registration-confirmed',
            with: [
                'registration' => $this->registration,
                'concert' => config('concert'),
            ],
        );
    }
}
