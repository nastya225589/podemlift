<?php

namespace App\Observers;

use Notification;
use App\Models\BackCall;
use App\Models\Settings;
use App\Notifications\BackCallNotify;

class BackCallObserver
{
    public function created(BackCall $backCall)
    {
        $toMail = Settings::where('name', 'email')->first();
        Notification::route('mail', $toMail->value)
                    ->notify(new BackCallNotify($backCall));
    }
}
