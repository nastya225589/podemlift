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
        $toMail = config('settings')->email;
        Notification::route('mail', $toMail)
                    ->notify(new BackCallNotify($backCall));
    }
}
