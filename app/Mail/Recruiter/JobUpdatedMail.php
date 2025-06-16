<?php

namespace App\Mail\Recruiter;

use App\Models\EmailTemplates;
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
    protected $subjectLine;
    /**
     * Create a new message instance.
     */
    public function __construct($jobPost,$recruiterName)
    {
        $this->jobPost = $jobPost;
        $this->recruiterName = $recruiterName;

        // Fetch subject from EmailTemplates table using a specific key
        $template          = EmailTemplates::where('id', '20')->first();
        $this->subjectLine = $template?->subject ?? 'Job Update Mail';
        $this->emailBody   = $template?->body ?? "
            <h2>Hello {{ recruiterName }},</h2>

            <p>Your job titled <strong>{{ title }}</strong> has been successfully Updated.</p>

            <p>It is currently under review by our admin team. You will be notified once it goes live.</p>

            <p>Thanks for choosing our platform!</p>

            <br>
            <p>Regards,</p>
            <p><strong>Job CareerNext</strong></p>
        ";
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectLine,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.recruiter.job_Updated',
            with: ['jobPost' => $this->jobPost,'recruiterName' => $this->recruiterName, 'body' => $this->emailBody],
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
