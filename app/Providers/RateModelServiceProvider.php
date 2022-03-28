<?php

namespace App\Providers;

use App\Rate;
use App\RateFree;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class RateModelServiceProvider extends ServiceProvider
{

    protected $prefix = Rate::class;

    /**
     * List of available models for different commands
     *
     * @var array
     */
    protected $availableClasses = [
        'rate:update-from-table' => [
            \App\RateFree::class,
            \App\RateStarter::class
        ],
        'rate:update-from-API' => [
            \App\RateEnterprise::class
        ]
    ];

    protected function getClassName()
    {
        return $this->prefix . ucfirst(strtolower($_SERVER['argv'][2]));
    }

    protected function getCommandName()
    {
        return  $_SERVER['argv'][1];
    }

    protected function isClassAvailableInCommand($class, $command)
    {
        return in_array($class, $this->availableClasses[$command]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {



        $this->app->singleton(Rate::class, function() {
            if($this->app->runningInConsole()) {
                if ($this->isClassAvailableInCommand($class = $this->getClassName(), $this->getCommandName())) {
                    return $this->app->make($class);
                } else {
                    error_log('No such table, or not available in this command !');
                    exit();
                }
            }
            if (Auth::check()) {
                $class = $this->prefix . Auth::user()->currentAccessToken()->tariff->name;
                return $this->app->make($class);
            } else {
                return $this->app->make(RateFree::class);
            }
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
