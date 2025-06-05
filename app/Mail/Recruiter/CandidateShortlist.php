<?php

namespace App\Mail\Recruiter;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CandidateShortlist extends Mailable
{
    use Queueable, SerializesModels;
    public $candidate;
    public $AppliedJob;
    /**
     * Create a new message instance.
     */
    public function __construct($candidate,$AppliedJob)
    {
        $this->candidate = $candidate;
        $this->AppliedJob = $AppliedJob;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job Shortlisted',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.recruiter.CandidateShortlisted',
            with: ['candidate' => $this->candidate,'AppliedJob' => $this->AppliedJob,],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
