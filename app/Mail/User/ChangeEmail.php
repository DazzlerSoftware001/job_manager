<?php
// namespace App\Mail;
namespace App\Mail\User;

use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ChangeEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $otp;
    protected $subjectLine;
    /**
     * Create a new message instance.
     */
    public function __construct($otp)
    {
        $this->otp = $otp;

        // Fetch subject from EmailTemplates table using a specific key
        $template          = EmailTemplates::where('id', '22')->first();
        $this->subjectLine = $template?->subject ?? 'Change Email';
        $this->emailBody   = $template?->body ?? "
            <h2>Hello!</h2>
            <p>Your OTP code for email verification is:</p>
            <h1>{{ otp }}</h1>
            <p>This OTP is valid for a short time. Please do not share it with anyone.</p>
            <br>
            <p>Thank you,<br>CareerNext&nbsp;</p>
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
            view: 'emails.User.ChangeEmail',
            with: ['otp' => $this->otp, 'body' => $this->emailBody],
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
