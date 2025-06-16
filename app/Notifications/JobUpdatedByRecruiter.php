<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\JobPost;

class JobUpdatedByRecruiter extends Notification
{
    use Queueable;
    protected $jobPost;
    protected $recruiterName;
    /**
     * Create a new notification instance.
     */
    public function __construct(JobPost $jobPost, $recruiterName)
    {
        $this->jobPost = $jobPost;
        $this->recruiterName = $recruiterName;
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
            'title' => 'Job Updated',
            'message' => "{$this->recruiterName} updated a job: {$this->jobPost->title}",
            'url' => url('/Admin/JobList'), // adjust this to your admin job view route
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
            'title' => 'Job Updated',
            'message' => "{$this->recruiterName} updated a job: {$this->jobPost->title}",
            'url' => url('/Admin/JobList'),
            'job_id' => $this->jobPost->id,
            'recruiter' => $this->recruiterName,
            'created_at' => now()
        ];
    }
}
