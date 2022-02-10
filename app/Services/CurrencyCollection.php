<?php


namespace App\Services;


use Carbon\Carbon;
use Illuminate\Support\Collection;

class CurrencyCollection extends Collection
{
    public function addElement($iso_code, $name, $currency_code, $rate, $date)
    {
        return $this->push(new Currency($iso_code, $name, $currency_code, $rate, $date));
    }

    public function addUahElement()
    {
        return $this->push(new Currency(980, 'Ukrainian hryvnia', 'UAH', 1.000000, Carbon::today()->format('d.m.Y')));
    }
}
