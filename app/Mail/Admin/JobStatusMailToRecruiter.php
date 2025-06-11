<?php
namespace App\Mail\Admin;

use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobStatusMailToRecruiter extends Mailable
{
    use Queueable, SerializesModels;
    public $JobPost;
    public $recruiter;
    protected $subjectLine;
    /**
     * Create a new message instance.
     */
    public function __construct($JobPost, $recruiter)
    {
        $this->JobPost   = $JobPost;
        $this->recruiter = $recruiter;

        // Fetch subject from EmailTemplates table using a specific key
        $template          = EmailTemplates::where('id', '6')->first();
        $this->subjectLine = $template?->subject ?? 'Job Status Change';
        $this->emailBody   = $template?->body ?? "
    Hello {{ name }} {{ lname }},
Your job titled {{ title }} has been {{ status }}. by Admin

Thanks for choosing our platform!


Regards,

Job Portal Team
";
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subjectLine . ' - ' . ($this->JobPost->status == 1 ? 'Activated and made live' : 'Inactivated'),
        );

    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.Admin.job_StatusToRecruiter',
            with: ['JobPost' => $this->JobPost, 'recruiter' => $this->recruiter, 'body' => $this->emailBody],
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
