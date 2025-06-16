<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JobAppliedByUser extends Notification
{
    use Queueable;
    protected $user;
    protected $job;
    /**
     * Create a new notification instance.
     */
    public function __construct($user,$job)
    {
        $this->user = $user;
        $this->job = $job;
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
            'title' => 'New Application',
            'message' => "{$this->user->name} {$this->user->lname} applied for job: {$this->job->title}",
            
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
            'title' => 'New Application',
            'message' => "{$this->user->name} {$this->user->lname} applied for job: {$this->job->title}",
            'url' => url('/Recruiter/allApplicants'), 
            'job_id' => $this->job->id,
            'user' => $this->user->name.''. $this->user->lname,
            'created_at' => now(),
        ];
    }

    // public function toArray(object $notifiable): array
    // {
    //     // Define base data
    //     $data = [
    //         'title' => 'New Application',
    //         'message' => "{$this->user->name} {$this->user->lname} applied for job: {$this->job->title}",
    //         'job_id' => $this->job->id,
    //         'user' => $this->user->name . ' ' . $this->user->lname,
    //         'created_at' => now(),
    //     ];

    //     // Custom URL based on user_type (1 = Admin, 2 = Recruiter)
    //     if ($notifiable->user_type == 1) {
    //         $data['url'] = url('/Admin/All-Applicants');
    //     } elseif ($notifiable->user_type == 2) {
    //         $data['url'] = url('/Recruiter/allApplicants');
    //     }

    //     return $data;
    // }

}
