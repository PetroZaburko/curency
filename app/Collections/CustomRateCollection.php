<?php


namespace App\Collections;


use Illuminate\Database\Eloquent\Collection;

class CustomRateCollection extends Collection
{
    public function findOneByCurrencyCode($code)
    {
        return $this->where('currency_code', $code)->first();
    }

    public function changeRateInCollection($rate)
    {
        return $this->each(function ($currency) use($rate) {
            $currency->rate = round( $rate / $currency->rate, 6);
        });
    }

}
