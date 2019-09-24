<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BackCallNotify extends Notification
{
    use Queueable;

    protected $backCall;

    public function __construct($backCall)
    {
        $this->backCall = $backCall;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Новый запрос на обратную связь.')
                    ->line('Поступил новый запрос на обратную связь.')
                    ->line('Имя: ' . $this->backCall->firstname)
                    ->line('Телефон: ' . $this->backCall->phone)
                    ->line('Email: ' . $this->backCall->email);
    }
}
