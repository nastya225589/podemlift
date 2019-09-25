<?php

namespace App\Providers;

use App\Models\BackCall;
use App\Models\Product;
use App\Models\ProjectRequest;
use App\Models\Questionnaire;
use App\Observers\BackCallObserver;
use App\Observers\ProductObserver;
use App\Observers\ProjectRequestObserver;
use App\Observers\QuestionnaireObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        setlocale(LC_ALL, 'ru_RU.utf8');
        \Carbon\Carbon::setLocale(config('app.locale'));
        Product::observe(ProductObserver::class);
        ProjectRequest::observe(ProjectRequestObserver::class);
        Questionnaire::observe(QuestionnaireObserver::class);
        BackCall::observe(BackCallObserver::class);
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');
    }
}
