<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\ProjectRequest;
use App\Observers\ProductObserver;
use App\Observers\ProjectRequestObserver;
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
        Product::observe(ProductObserver::class);
        ProjectRequest::observe(ProjectRequestObserver::class);
        Validator::extend('recaptcha', 'App\\Validators\\ReCaptcha@validate');
    }
}
