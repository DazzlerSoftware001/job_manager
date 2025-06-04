<?php

namespace App\Mail\Recruiter;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobUpdatedMail extends Mailable
{
    use Queueable, SerializesModels;
    public $jobPost;
    public $recruiterName;
    /**
     * Create a new message instance.
     */
    public function __construct($jobPost,$recruiterName)
    {
        $this->jobPost = $jobPost;
        $this->recruiterName = $recruiterName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Job Has Been Updated Successfully',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.recruiter.job_Updated',
            with: ['jobPost' => $this->jobPost,'recruiterName' => $this->recruiterName,],
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
