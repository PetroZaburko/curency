<?php

namespace App\Observers;

use App\Rate;
use Illuminate\Support\Facades\Cache;

class RateObserver
{
    public function created(Rate $rate)
    {
        Cache::forget($rate->getTable());
    }
}
