<?php
namespace App\Mail\Admin;

use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobPostMailToRecruiter extends Mailable
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
        $template          = EmailTemplates::where('id', '5')->first();
        $this->subjectLine = $template?->subject ?? 'Job Posted';
        $this->emailBody   = $template?->body ?? "
    <h2>Hello {{ name }} {{ lname }},</h2>

    <p>New job titled <strong>{{ title }}</strong> has been successfully posted by <strong>Admin</strong></p>

   <p>It is currently under review by our admin team. You will be notified once it goes live.</p>

    <br>
    <p>Thanks,</p>

    <p><strong>Your Job Portal</strong></p>
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
            view: 'emails.Admin.job_postedToRecruiter',
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
