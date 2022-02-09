<?php


namespace App\Providers;

use App\Services\CurrencyIterator;
use App\Services\CurrencyService;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->tag(config('currency_sources'),[CurrencyService::class]);

        $this->app->bind(CurrencyIterator::class, function () {
            return new CurrencyIterator($this->app->tagged(CurrencyService::class));
        });
    }
}
