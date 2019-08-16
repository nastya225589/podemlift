<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use UserConfig;

class ViewGlobalVariablesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('perPage', UserConfig::getProductsPerPageCount());
        View::share('catalogListingInline', UserConfig::catalogListingInline());
    }
}
