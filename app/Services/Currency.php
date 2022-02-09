<?php


namespace App\Services;


class Currency
{
    private $code;
    private $name;
    private $currency;
    private $rate;
    private $date;

    public function __construct($code, $name, $currency, $rate, $date)
    {
        $this->code = $code;
        $this->name = $name;
        $this->currency = $currency;
        $this->rate = $rate;
        $this->date = $date;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCurrency()
    {
        return $this->currency;
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
