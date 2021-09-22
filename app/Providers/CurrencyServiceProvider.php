<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->app->bind('Parser', \App\Helpers\Currency::class);
    }

}
