<?php


namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->bind('Parser', \App\Helpers\Currency::class);
    }
}
