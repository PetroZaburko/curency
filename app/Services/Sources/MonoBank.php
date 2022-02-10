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
        foreach ($data as $element) {
            if ($element['currencyCodeB'] == 980) {
                if (!isset($this->currency_codes[$element['currencyCodeA']])) {
                    continue;
                }
                $iso_code = $element['currencyCodeA'];
                $name = $this->currency_codes[$element['currencyCodeA']]['Name'];
                $currency_code = $this->currency_codes[$element['currencyCodeA']]['Code'];
                $rate = isset($element['rateSell']) ? $element['rateSell'] : $element['rateCross'];
                $date = Carbon::parse((int)$element['date'])->format('d.m.Y');
                $this->collection->addElement($iso_code, $name, $currency_code, $rate, $date);
            }
        }
        $this->collection->addUahElement();
        return $this->collection;
    }

}
