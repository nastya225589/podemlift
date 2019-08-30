<?php

namespace App\Observers;

use Notification;
use App\Models\ProjectRequest;
use App\Notifications\ProjectRequestNotify;

class ProjectRequestObserver
{
    public function created(ProjectRequest $projectRequest)
    {
        Notification::route('mail', 'taylor@example.com')
                    ->notify(new ProjectRequestNotify($projectRequest));
    }
}
