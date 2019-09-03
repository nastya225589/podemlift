<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ProjectRequestNotify extends Notification
{
    use Queueable;

    protected $projectRequest;

    public function __construct($projectRequest)
    {
        $this->projectRequest = $projectRequest;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Новый запрос на проект.')
                    ->line('Поступил новый запрос на проект.')
                    ->line('Имя: ' . $this->projectRequest->firstname)
                    ->line('Телефон: ' . $this->projectRequest->phone);
    }
}
