<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobVerifyMailToRecruiter extends Mailable
{
    use Queueable, SerializesModels;
    public $JobPost;
    public $recuiter;
    /**
     * Create a new message instance.
     */
    public function __construct($JobPost,$recuiter)
    {
        $this->JobPost = $JobPost;
        $this->recuiter = $recuiter;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Job Verification Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.Admin.job_VerifyToRecruiter',
            with: ['JobPost' => $this->JobPost,'recuiter' =>$this->recuiter],
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
