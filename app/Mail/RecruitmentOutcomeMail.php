<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecruitmentOutcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Application $application,
        public string $outcomeType, // 'offered' or 'rejected'
        public ?string $remarks = null
    ) {
    }

    public function envelope(): Envelope
    {
        $subject = $this->outcomeType === 'offered'
            ? 'Career Opportunity Offer: ' . ($this->application->jobVacancy?->title ?? 'Olympia Education')
            : 'Update Regarding Your Application: ' . ($this->application->jobVacancy?->title ?? 'Olympia Education');

        return new Envelope(
            subject: $subject . ' [' . $this->application->reference_number . ']',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.recruitment-outcome',
        );
    }
}
