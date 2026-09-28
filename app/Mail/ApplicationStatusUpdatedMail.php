<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationStatusUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Application $application,
        public string $previousStatus,
        public ?string $remarks = null
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Application Status Update: ' . $this->application->status . ' [' . $this->application->reference_number . ']',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application-status-updated',
        );
    }
}
