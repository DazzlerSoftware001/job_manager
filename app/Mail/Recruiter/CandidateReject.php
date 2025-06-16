<?php
namespace App\Mail\Recruiter;

use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CandidateReject extends Mailable
{
    use Queueable, SerializesModels;
    public $candidate;
    public $AppliedJob;
    protected $subjectLine;
    /**
     * Create a new message instance.
     */
    public function __construct($candidate, $AppliedJob)
    {
        $this->candidate  = $candidate;
        $this->AppliedJob = $AppliedJob;

        // Fetch subject from EmailTemplates table using a specific key
        $template          = EmailTemplates::where('id', '12')->first();
        $this->subjectLine = $template?->subject ?? 'Job Reject';
        $this->emailBody   = $template?->body ?? "
            <h2>Hello {{ name }} {{ lname }} </h2>

            <p>You are Rejected for the job <strong>{{ title }}</strong>.</p>

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
            view: 'emails.recruiter.CandidateRejected',
            with: ['candidate' => $this->candidate, 'AppliedJob' => $this->AppliedJob, 'body' => $this->emailBody],
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
