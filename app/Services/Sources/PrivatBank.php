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

    /**
     * @param array $data
     * @return CurrencyCollection
     */
    protected function normalizeData($data)
    {
        $collection = collect($data['exchangeRate']);
        foreach ($this->currency_codes as $element) {
            if($currency = $collection->where('currency', $element['currency_code'])->first()) {
                $iso_code = $element['iso_code'];
                $name = $element['name'];
                $currency_code = $element['currency_code'];
                $rate = isset($currency['saleRate']) ? $currency['saleRate'] : $currency['saleRateNB'];;
                $date = $data['date'];;
                $this->collection->addElement($iso_code, $name, $currency_code, $rate, $date);
            }
        }
        $this->collection->addUahElement();
        return $this->collection;
    }

}
