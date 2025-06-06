<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobStatusMailToRecruiter extends Mailable
{
    use Queueable, SerializesModels;
     public $JobPost;
    public $recruiter;
    /**
     * Create a new message instance.
     */
    public function __construct($JobPost,$recruiter)
    {
        $this->JobPost = $JobPost;
        $this->recruiter = $recruiter;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job ' . ($this->JobPost->status == 1 ? 'Activated and made live' : 'Inactived') . ' ',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.Admin.job_StatusToRecruiter',
            with: ['JobPost' => $this->JobPost,'recruiter' =>$this->recruiter],
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
