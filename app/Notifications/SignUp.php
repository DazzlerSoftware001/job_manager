<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SignUp extends Notification
{
    use Queueable;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
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
            'title' => 'New User',
            'message' => "{$this->user->name} {$this->user->lname} New User Registered",
            'url' => url('/Admin/UserList'),
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
            'title' => 'New User',
            'message' => "{$this->user->name} {$this->user->lname} New user registered",
            'url' => url('Admin/UserList'), 
            'user' => $this->user->name.''. $this->user->lname,
            'created_at' => now(),
        ];
    }
}
