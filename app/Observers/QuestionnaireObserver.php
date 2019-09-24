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
        $toMail = Settings::where('name', 'email')->first();
        Notification::route('mail', $toMail->value)
                    ->notify(new QuestionnaireNotify($questionnaire));
    }
}
