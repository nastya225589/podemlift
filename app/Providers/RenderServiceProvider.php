<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RenderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Services\Contracts\RenderServiceInterface',
            'App\Services\RenderService'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
