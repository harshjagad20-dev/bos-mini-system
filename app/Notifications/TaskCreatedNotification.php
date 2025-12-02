<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $task;

    /**
     * Create a new notification instance.
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("New Task Assigned: {$this->task->title}")  // Email subject
            ->greeting("Hello {$notifiable->name},")               // Greeting

            ->line("A new task has been assigned to you in the project **{$this->task->project->title}**.")  

            ->line("**Task Details:**")
            ->line("• **Task:** {$this->task->title}")
            ->line("• **Deadline:** " . ($this->task->deadline ?? 'N/A'))
            ->line("• **Status:** {$this->task->status}")

            ->line('If you have any questions, feel free to contact your project manager.')
            ->salutation("Regards,\nBOS System"); // Email footer
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
