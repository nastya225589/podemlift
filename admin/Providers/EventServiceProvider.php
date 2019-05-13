<?php

namespace Admin\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Admin\Models\Page;
use Admin\Models\Menu;
use Admin\Models\Settings;
use Admin\Models\Form;
use Admin\Models\Redirect;
use Admin\Models\Log;
use Admin\Mail\FormSended;
use Illuminate\Support\Facades\Mail;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Page::saving(function($model) {
            Log::model($model);
        });

        Menu::saving(function($model) {
            Log::model($model);
        });

        Settings::updating(function($model) {
            Log::model($model);
        });

        Page::saving(function($model) {
            $newUrl = $model->fullUrl();

            if ($newUrl != $model->url) {
                if ($model->id)
                    Redirect::firstOrCreate([
                        'from' => $model->url,
                        'model' => 'Page',
                        'model_id' => $model->id
                    ]);

                $model->url = $newUrl;
            }
        });

        Page::saved(function($model) {
            if (count($model->childrens))
                foreach ($model->childrens as $children)
                    if ($children->url != $children->fullUrl())
                        $children->save();
        });

        Form::saved(function($model) {
            Mail::to(env('MAIL_TO'))
                ->send(new FormSended($model));
        });
    }
}
