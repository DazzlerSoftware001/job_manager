<?php
namespace App\Mail\Admin;

use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AddRecruiterMailToRecruiter extends Mailable
{
    use Queueable, SerializesModels;
    public $Recruiter;
    protected $subjectLine;
    /**
     * Create a new message instance.
     */
    public function __construct($Recruiter)
    {
        $this->Recruiter = $Recruiter;

        // Fetch subject from EmailTemplates table using a specific key
        $template          = EmailTemplates::where('id', '1')->first();
        $this->subjectLine = $template?->subject ?? 'Profile Created';
        $this->emailBody   = $template?->body ?? "
    <h2>Hello {{ name }} {{ lname }},</h2>
    <p>Your profile has been {{ status }}. by <strong>Admin</strong></p>
    <p>Thanks for choosing our platform!</p>
    <br>
    <p>Regards,</p>
    <p><strong>Job Portal Team</strong></p>
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
            view: 'emails.Admin.AddRecruiterToRecruiter',
            with: ['Recruiter' => $this->Recruiter, 'body' => $this->emailBody],
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
