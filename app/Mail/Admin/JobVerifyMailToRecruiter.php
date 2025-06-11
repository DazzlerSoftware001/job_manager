<?php
namespace App\Mail\Admin;

use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobVerifyMailToRecruiter extends Mailable
{
    use Queueable, SerializesModels;
    public $JobPost;
    public $recuiter;
    protected $subjectLine;
    /**
     * Create a new message instance.
     */
    public function __construct($JobPost, $recuiter)
    {
        $this->JobPost  = $JobPost;
        $this->recuiter = $recuiter;

        // Fetch subject from EmailTemplates table using a specific key
        $template          = EmailTemplates::where('id', '8')->first();
        $this->subjectLine = $template?->subject ?? 'Job Verification Mail';
        $this->emailBody   = $template?->body ?? "
    Hello {{ name }} {{ lname }},
Job titled {{ title }} is {{ admin_verify }} by Admin .

It is currently under review by our admin team. You will be notified once it goes live.


Thanks,

Your CareerNest


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
            view: 'emails.Admin.job_VerifyToRecruiter',
            with: ['JobPost' => $this->JobPost, 'recuiter' => $this->recuiter, 'body' => $this->emailBody],
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
