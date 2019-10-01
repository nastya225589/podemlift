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
        $toMail = config('settings')->email;
        Notification::route('mail', $toMail)
                    ->notify(new FormQuestionNotify($formQuestion));
    }
}
