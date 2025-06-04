<?php

namespace App\Mail\Recruiter;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobStatusChangedMailToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $JobPost;
    public $recruiterName;
    /**
     * Create a new message instance.
     */
    public function __construct($JobPost, $recruiterName)
    {
        $this->JobPost = $JobPost;
        $this->recruiterName = $recruiterName;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job Status ' . ($this->JobPost->status == 1 ? 'Activated and made live' : 'Inactived') . ' Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.recruiter.job_status_changed_toAdmin',
            with: ['JobPost' => $this->JobPost,'recruiterName' => $this->recruiterName,],
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
