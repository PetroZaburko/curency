<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RateCollection;
use App\Rate;

class ApiRateController extends Controller
{

    public function index(Rate $rate, $base = null)
    {
        $all = $rate->allLastUpdated();
        if (!$base) {
            return new RateCollection($all);
        }
        $base = strtoupper($base);
        if (!$baseCurrency = $all->findOneByCurrencyCode($base)) {
            return response([
                'message' => 'Sorry, such currency does not exist!'
            ], 200);
        }
        $result = $all->changeRateInCollection($baseCurrency->rate);
        return new RateCollection($result, $base);
    }
}
