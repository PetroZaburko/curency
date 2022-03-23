<?php


namespace App\Services;


class Currency
{
    public $iso_code;
    public $name;
    public $currency_code;
    public $rate;
    public $date;

    public function __construct($iso_code, $name, $currency_code, $rate, $date)
    {
        $this->iso_code = $iso_code;
        $this->name = $name;
        $this->currency_code = $currency_code;
        $this->rate = $rate;
        $this->date = $date;
    }

}
