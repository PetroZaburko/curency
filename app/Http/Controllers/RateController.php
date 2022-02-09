<?php

namespace App\Http\Controllers;

use App\Exceptions\CurrencyException;
use App\Rate;
use App\Services\CurrencyIterator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class RateController extends Controller
{
    protected $lastUpdatedDate ;

    public function index(CurrencyIterator $iterator)
    {
        $this->updateDB($iterator);
        $rates = Rate::allLastUpdated();
        $date = $rates->max('created_at')->format('d-m-Y');
        $rates = $rates->toJson(JSON_UNESCAPED_UNICODE);
        return view('content', compact('rates','date'));
    }

    private function isTimeToUpdateDB()
    {
        if ($maxDate = Rate::max('created_at')) {
            return $maxDate->toDateTime() < Carbon::today()->toDateTime();
        }
        return true;
    }

    private function updateDB(CurrencyIterator $iterator)
    {
        if($this->isTimeToUpdateDB()) {
            try {
                $allCurrency = $iterator->exchange()->getCurrency();
                Rate::saveAll($allCurrency);
            } catch (CurrencyException $e) {
                Session::put('error', $e->getMessage());
            }
        }
    }
}
