<?php
namespace App\Mail\User;

use App\Models\EmailTemplates;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyEmail extends Mailable
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
        $template          = EmailTemplates::where('id', '24')->first();
        $this->subjectLine = $template?->subject ?? 'Verify Email';
        $this->emailBody   = $template?->body ?? "
            <h2>Hello!</h2>
            <p>Thank you for registering.</p>
            <p>Your One-Time Password (OTP) for email verification is:</p>
            <h3>{{ otp }}</h3>
            <p>This OTP will expire in 5 minutes.</p>
            <p>If you didn't request this, you can ignore this email.</p>
            <br>
            <p>Regards,<br>Your CareerNext Team</p>
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
            view: 'emails.User.VerifyEmail',
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
