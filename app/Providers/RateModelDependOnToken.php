<?php

namespace App\Providers;

use App\Rate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class RateModelDependOnToken extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Rate::class, function() {
            $class = '\App\Rate' . Auth::user()->currentAccessToken()->tariff->name;
            return $this->app->make($class);
        });
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
