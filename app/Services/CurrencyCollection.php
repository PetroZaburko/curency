<?php


namespace App\Services;


use Illuminate\Support\Collection;

class CurrencyCollection extends Collection
{
    public function addElement($code, $name, $currency, $rate, $date)
    {
        return $this->push(new Currency($code, $name, $currency, $rate, $date));
    }
}
