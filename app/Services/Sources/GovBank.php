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
        foreach ($data as $element) {
            if (!isset($this->currency_codes[$element['r030']])) {
                continue;
            }
            $iso_code = $element['r030'];
            $name = $this->currency_codes[$element['r030']]['Name'];
            $currency_code= $element['cc'];
            $rate = $element['rate'];
            $date = $element['exchangedate'];
            $this->collection->addElement($iso_code, $name, $currency_code, $rate, $date);
        }
        $this->collection->addUahElement();
        return $this->collection;
    }

}
