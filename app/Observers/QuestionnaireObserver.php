<?php

namespace App\Observers;

use Notification;
use App\Models\Settings;
use App\Models\Questionnaire;
use App\Notifications\QuestionnaireNotify;

class QuestionnaireObserver
{
    public function created(Questionnaire $questionnaire)
    {
        $toMail = config('settings')->email;
        Notification::route('mail', $toMail)
                    ->notify(new QuestionnaireNotify($questionnaire));
    }
}
