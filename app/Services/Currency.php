<?php


namespace App\Services;


class Currency
{
    private $iso_code;
    private $name;
    private $currency_code;
    private $rate;
    private $date;

    public function __construct($iso_code, $name, $currency_code, $rate, $date)
    {
        $this->iso_code = $iso_code;
        $this->name = $name;
        $this->currency_code = $currency_code;
        $this->rate = $rate;
        $this->date = $date;
    }

    public function getIsoCode()
    {
        return $this->iso_code;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCurrencyCode()
    {
        return $this->currency_code;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function getDate()
    {
        return $this->date;
    }
}
