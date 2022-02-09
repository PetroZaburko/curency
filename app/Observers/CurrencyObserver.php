<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class CurrencyObserver
{
    public function created()
    {
        Cache::forget('currency');
    }
}
