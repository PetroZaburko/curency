<?php


namespace App\Providers;

use App\Services\CurrencyIterator;
use App\Services\CurrencyService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CurrencyServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->tag(config('currency_sources'),[CurrencyService::class]);

        $this->app->bind(CurrencyIterator::class, function () {
            return new CurrencyIterator($this->app->tagged(CurrencyService::class));
        });
    }

    public function provides()
    {
        return [CurrencyIterator::class];
    }


}
