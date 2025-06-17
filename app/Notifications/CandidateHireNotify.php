<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CandidateHireNotify extends Notification
{
    use Queueable;
    protected $AppliedJob;

    /**
     * Create a new notification instance.
     */
    public function __construct($AppliedJob)
    {
        $this->AppliedJob = $AppliedJob;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Candidate Hired',
            'message' => "Congratulations you are hired for job: {$this->AppliedJob->title}",
        ];

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Candidate Hired',
            'message' => "Congratulations you are hired for job: {$this->AppliedJob->title}",
            'created_at' => now(),
        ];
    }
}
