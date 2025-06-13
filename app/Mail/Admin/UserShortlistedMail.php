<?php
namespace App\Mail\Admin;

use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserShortlistedMail extends Mailable
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
        $template          = EmailTemplates::where('id', '4')->first();
        $this->subjectLine = $template?->subject ?? 'User Shortlisted Mail';
        $this->emailBody   = $template?->body ?? "
            <h2>Hello {{ name }} {{ lname }},</h2>

            <p>Congratulations! You have been <strong>shortlisted</strong> for the job:</p>

            <h3>{{ title }}</h3>
            <p><strong>Company:</strong> {{ com_name }}</p>
            <p><strong>Location:</strong> {{ location }}</p>

            <p>Our team will contact you soon with further details.</p>

            <br>
            <p>Best regards,</p>
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
            view: 'emails.Admin.CandidateShortlisted',
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
