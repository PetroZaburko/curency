<?php


namespace App\Services\Sources;


use App\Services\CurrencyCollection;
use App\Services\CurrencyService;
use Carbon\Carbon;


class MonoBank extends CurrencyService
{
    const BASE_URI = 'https://api.monobank.ua';
    const SOURCE_NAME = 'MonoBank';

    protected $uri = "/bank/currency";

    /**
     * @param array $data
     * @return CurrencyCollection
     */
    protected function normalizeData($data)
    {
        $collection = collect($data);
        foreach ($this->currency_codes as $element) {
            if($currency = $collection->where('currencyCodeB', 980)->where('currencyCodeA', $element['iso_code'])->first()) {
                $iso_code = $element['iso_code'];
                $name = $element['name'];
                $currency_code = $element['currency_code'];
                $rate = isset($currency['rateSell']) ? $currency['rateSell'] : $currency['rateCross'];
                $date = Carbon::parse((int)$currency['date'])->format('d.m.Y');
                $this->collection->addElement($iso_code, $name, $currency_code, $rate, $date);
            }
        }
        $this->collection->addUahElement();
        return $this->collection;
    }

}
