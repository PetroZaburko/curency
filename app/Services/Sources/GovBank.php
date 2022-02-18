<?php


namespace App\Services\Sources;


use App\Services\CurrencyCollection;
use App\Services\CurrencyService;


class GovBank extends CurrencyService
{
    const API_VERSION = 'v1';
    const BASE_URI = 'https://bank.gov.ua';
    const SOURCE_NAME = 'National Bank of Ukraine';

    protected $uri = "/NBUStatService/" . self::API_VERSION . "/statdirectory/exchange?json";

    /**
     * @param array $data
     * @return CurrencyCollection
     */
    protected function normalizeData($data)
    {
        $collection = collect($data);
        foreach ($this->currency_codes as $element) {
            if ($currency = $collection->where('r030', $element['iso_code'])->first()) {
                $iso_code = $element['iso_code'];
                $name = $element['name'];
                $currency_code = $element['currency_code'];;
                $rate = $currency['rate'];
                $date = $currency['exchangedate'];
                $this->collection->addElement($iso_code, $name, $currency_code, $rate, $date);
            }
        }
        $this->collection->addUahElement();
        return $this->collection;
    }

}
