<?php

namespace App;

use App\Traits\RateModelTrait;

class RateStarter extends Rate
{
    use RateModelTrait;

    protected $table = 'rates_starter';
}
