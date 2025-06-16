<?php
namespace App\Mail\Recruiter;

use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class JobStatusChangedMailToAdmin extends Mailable
{
    use Queueable, SerializesModels;
    public $JobPost;
    public $recruiterName;
    protected $subjectLine;
    /**
     * Create a new message instance.
     */
    public function __construct($JobPost, $recruiterName)
    {
        $this->JobPost       = $JobPost;
        $this->recruiterName = $recruiterName;

        // Fetch subject from EmailTemplates table using a specific key
        $template          = EmailTemplates::where('id', '16')->first();
        $this->subjectLine = $template?->subject ?? 'Job Status Change Mail';
        $this->emailBody   = $template?->body ?? "
            <p>Job titled <strong>{{ title }}</strong> has been {{ status }} by <strong>{{ recruiterName }} </strong>.</p>

            <p>Please review the job in the admin panel.</p>

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
            subject: 'Job Status ' . ($this->JobPost->status == 1 ? 'Activated and made live' : 'Inactived') . ' Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.recruiter.job_status_changed_toAdmin',
            with: ['JobPost' => $this->JobPost, 'recruiterName' => $this->recruiterName, 'body' => $this->emailBody],
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
