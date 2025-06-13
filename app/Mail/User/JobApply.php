<?php
namespace App\Mail\User;

use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobApply extends Mailable
{
    use Queueable, SerializesModels;
    public $Recruiter;
    public $user;
    protected $subjectLine;
    /**
     * Create a new message instance.
     */
    public function __construct($Recruiter, $user)
    {
        $this->Recruiter = $Recruiter;
        $this->user      = $user;

        // Fetch subject from EmailTemplates table using a specific key
        $template          = EmailTemplates::where('id', '23')->first();
        $this->subjectLine = $template?->subject ?? 'Job Application';
        $this->emailBody = $template?->body ?? "
            <h2>Hello {{ recruiter_name }} {{ recruiter_lname }}</h2>
            <p><strong>{{ user_name }} {{ user_lname }}</strong> applied to your job.</p>
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
            view: 'emails.User.JobApplied',
            with: ['Recruiter' => $this->Recruiter, 'user' => $this->user, 'body' => $this->emailBody],
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
