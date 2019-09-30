<?php

namespace App\Observers;

use Notification;
use App\Models\FormQuestion;
use App\Models\Settings;
use App\Notifications\FormQuestionNotify;

class FormQuestionObserver
{
    public function created(FormQuestion $formQuestion)
    {
        $toMail = Settings::where('name', 'email')->first();
        Notification::route('mail', $toMail->value)
                    ->notify(new FormQuestionNotify($formQuestion));
    }
}
