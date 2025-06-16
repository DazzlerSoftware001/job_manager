<?php
namespace App\Mail\Recruiter;

use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobUpdatedMailToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $jobPost;
    public $recruiterName;
    protected $subjectLine;
    /**
     * Create a new message instance.
     */
    public function __construct($jobPost, $recruiterName)
    {
        $this->jobPost       = $jobPost;
        $this->recruiterName = $recruiterName;

        // Fetch subject from EmailTemplates table using a specific key
        $template          = EmailTemplates::where('id', '21')->first();
        $this->subjectLine = $template?->subject ?? 'Job Update Mail';
        $this->emailBody   = $template?->body ?? "
            <h2>Job Updated Confirmation</h2>

            <p>Job titled <strong>{{ title }}</strong> has been successfully updated by <strong>{{ recruiterName }} </strong></p>

            <p>Please review and approve the job post in the admin panel.</p>

            <br>
            <p>Thanks,</p>

            <p><strong>Your CareerNext</strong></p>
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
            view: 'emails.recruiter.job_UpdatedToAdmin',
            with: ['jobPost' => $this->jobPost, 'recruiterName' => $this->recruiterName, 'body' => $this->emailBody],
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
