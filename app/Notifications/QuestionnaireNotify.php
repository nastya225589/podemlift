<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class QuestionnaireNotify extends Notification
{
    use Queueable;

    protected $questionnaire;

    public function __construct($questionnaire)
    {
        $this->questionnaire = $questionnaire;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = (new MailMessage)
                    ->subject('Новый опросный лист.')
                    ->line('Вам прислали новый опросный лист.')
                    ->line('Имя: ' . $this->questionnaire->firstname)
                    ->line('Организация: ' . $this->questionnaire->organization)
                    ->line('Телефон: ' . $this->questionnaire->phone)
                    ->line('Email: ' . $this->questionnaire->email);
        
        if ($this->questionnaire->mailing_address) {
            $message = $message->line('Почтовый адрес: ' . $this->questionnaire->mailing_address);
        }

        if ($this->questionnaire->delivery_at) {
            $message = $message->line('Желаемая или максимальная дата поставки/монтажа: ' . $this->questionnaire->delivery_at);
        }

        if ($this->questionnaire->delivery) {
            $message = $message->line('Доставка и монтаж: ' . $this->questionnaire->delivery);
        }

        if ($this->questionnaire->carrying) {
            $message = $message->line('Грузоподъемность, ru: ' . $this->questionnaire->carrying);
        }

        if ($this->questionnaire->lift) {
            $message = $message->line('Высота подъема: ' . $this->questionnaire->lift);
        }

        if ($this->questionnaire->type_of_lift) {
            $message = $message->line('Тип подъемника: ' . $this->questionnaire->type_of_lift);
        }

        if ($this->questionnaire->place) {
            $message = $message->line('Место установки: ' . $this->questionnaire->place);
        }

        if ($this->questionnaire->number_of_stops) {
            $message = $message->line('Количество фиксированных остановок: ' . $this->questionnaire->number_of_stops);
        }

        if ($this->questionnaire->load_method) {
            $collection = collect($this->questionnaire->load_method);
            $message = $message->line('Способ загрузки платформы: ' . $collection->implode(', '));
        }

        if ($this->questionnaire->type_of_platform) {
            $message = $message->line('Тип платформы: ' . $this->questionnaire->type_of_platform);
        }

        if ($this->questionnaire->tailgate) {
            $message = $message->line('Откидные борты на платформе со сторон загрузки/выгрузки: Да');
        } else {
            $message = $message->line('Откидные борты на платформе со сторон загрузки/выгрузки: Нет');
        }

        if ($this->questionnaire->swing_doors) {
            $message = $message->line('Распашные двери платформы подъемника со сторон загрузки: Да');
        } else {
            $message = $message->line('Распашные двери платформы подъемника со сторон загрузки: Нет');
        }

        if ($this->questionnaire->signaling) {
            $message = $message->line('Системы сигнализации: Да');
        } else {
            $message = $message->line('Системы сигнализации: Нет');
        }

        if ($this->questionnaire->additionally) {
            $message = $message->line('Примечания: ' . $this->questionnaire->additionally);
        }

        return $message;
    }
}
