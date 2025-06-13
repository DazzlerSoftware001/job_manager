<?php
namespace App\Mail\Admin;

use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserRejectedMail extends Mailable
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
        $this->job  = $job;

        // Fetch subject from EmailTemplates table using a specific key
        $template          = EmailTemplates::where('id', '3')->first();
        $this->subjectLine = $template?->subject ?? 'User Rejected Mail';
        $this->emailBody   = $template?->body ?? "
            <h2>Hello {{ name }} {{ lname }},</h2>

            <p>Thank you for applying to the job <strong>{{ title }}</strong> at <strong>{{ com_name }}</strong>.</p>

            <p>After careful consideration, we regret to inform you that you have not been selected for this position.</p>

            <p>We appreciate your interest and encourage you to apply for future opportunities that match your profile.</p>

            <br>
            <p>Best wishes,</p>
            <p>CareerNext Team</p>
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
            view: 'emails.Admin.CandidateRejected',
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
