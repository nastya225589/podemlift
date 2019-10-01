<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FormQuestionNotify extends Notification
{
    use Queueable;

    protected $formQuestion;

    public function __construct($formQuestion)
    {
        $this->formQuestion = $formQuestion;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Новый вопрос.')
                    ->line('Поступил новый вопрос.')
                    ->line('Имя: ' . $this->formQuestion->firstname)
                    ->line('Телефон: ' . $this->formQuestion->phone)
                    ->line('Компания: ' . $this->formQuestion->company)
                    ->line('Вопрос: ' . $this->formQuestion->question);
    }
}
