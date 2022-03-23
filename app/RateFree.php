<?php

namespace App;

use App\Traits\RateModelTrait;

class RateFree extends Rate
{
    use RateModelTrait;

    protected $table = 'rates_free';
}
