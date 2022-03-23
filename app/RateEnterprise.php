<?php

namespace App;

use App\Exceptions\CurrencyException;
use App\Services\CurrencyIterator;
use Illuminate\Support\Facades\Log;

class RateEnterprise extends Rate
{
    protected $table = 'rates_enterprise';

    public function updateDB($object)
    {
        return $this->updateFromAPI($object);
    }

    protected function updateFromAPI(CurrencyIterator $iterator)
    {
        try {
            $allCurrency = $iterator->exchange()->getCurrency();
            $this->saveAll($allCurrency);
            Log::info("Table $this->table was successful updated from API source {$iterator->exchange()->getResourceName()} !");
            return true;
        } catch (CurrencyException $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
