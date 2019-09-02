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
        $toMail = Settings::where('name', 'email')->first();
        Notification::route('mail', $toMail->value)
                    ->notify(new ProjectRequestNotify($projectRequest));
    }
}
