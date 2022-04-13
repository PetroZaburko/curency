<?php


namespace App\Traits;

use App\Rate;
use Illuminate\Support\Facades\Log;

trait RateModelTrait
{
    public function updateDB($object)
    {
        if ($result = $this->updateFromTable($object)) {
            $this->makeAllLastUpdatedCache();
        }
        return $result;
    }

    protected function updateFromTable(Rate $rate)
    {
        try {
            $this->saveAll($rate->allLastUpdated());
            Log::info("Table $this->table was successful updated from table {$rate->getTable()} !");
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
