<?php

namespace App\Mail\Admin;

use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserHiredMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $job;
    protected $subjectLine;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $job)
    {
        $this->user = $user;
        $this->job = $job;

        // Fetch subject from EmailTemplates table using a specific key
        $template          = EmailTemplates::where('id', '2')->first();
        $this->subjectLine = $template?->subject ?? 'User Hired Mail';
        $this->emailBody   = $template?->body ?? "
            <h2>Dear {{ name }} {{ lname }},</h2>

            <p>We are excited to inform you that you have been <strong>hired</strong> for the position of <strong>{{ title }}</strong> at <strong>{{ com_name }}</strong>.</p>

            <p>Welcome aboard! Our HR team will contact you shortly with onboarding instructions and next steps.</p>

            <br>
            <p>We look forward to working with you.</p>
            <p>Best regards,</p>
            <p>Job Portal Team</p>
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
            view: 'emails.Admin.CandidateHired',
            with: ['user' => $this->user, 'job' => $this->job, 'body' => $this->emailBody],
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
