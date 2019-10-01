<?php

namespace App\Observers;

use Notification;
use App\Models\ProjectRequest;
use App\Models\Settings;
use App\Notifications\ProjectRequestNotify;

class ProjectRequestObserver
{
    public function created(ProjectRequest $projectRequest)
    {
        $toMail = config('settings')->email;
        Notification::route('mail', $toMail)
                    ->notify(new ProjectRequestNotify($projectRequest));
    }
}
