<?php


namespace App\Services\Sources;


use App\Services\CurrencyCollection;
use App\Services\CurrencyService;
use Carbon\Carbon;

class PrivatBank extends CurrencyService
{
    const BASE_URI = 'https://api.privatbank.ua';
    const SOURCE_NAME = 'PrivatBank';

    protected $uri = '/p24api/exchange_rates?json&date=';

    public function __construct(CurrencyCollection $collection)
    {
        parent::__construct($collection);
        $this->uri .= Carbon::today()->format('d.m.Y');
    }

    protected function normalizeData($data)
    {
        foreach ($data['exchangeRate'] as $element) {
            if (!isset($element['currency'])) {
                continue;
            }
            if ($element['currency'] == 'UAH') {
                continue;
            }
            foreach ($this->currency_codes as $code => $value) {
                if ($element['currency'] == $value['Code']) {
                    $name = $value['Name'];
                    $currency = $element['currency'];
                    $rate = isset($element['saleRate']) ? $element['saleRate'] : $element['saleRateNB'];
                    $date = $data['date'];
                    $this->collection->addElement($code, $name, $currency, $rate, $date);
                }
            }
        }
        return $this->collection;
    }

}
