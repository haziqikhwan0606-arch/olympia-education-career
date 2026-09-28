<?php

namespace App\Mail;

use App\Models\Application;
use App\Models\Interview;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InterviewScheduledMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Application $application,
        public Interview $interview
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Interview Invitation: ' . ($this->application->jobVacancy?->title ?? 'Position at Olympia Education') . ' [' . $this->application->reference_number . ']',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.interview-scheduled',
        );
    }
}
