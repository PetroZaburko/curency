<?php

namespace App\Http\Controllers;

use App\Facades\Parser;
use App\Exceptions\CurrencyException;
use App\Rate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class RateController extends Controller
{

    public function index()
    {
        $this->updateDB();
        $rates = Rate::all()->toJson(JSON_UNESCAPED_UNICODE);
        return view('content', compact('rates'));
    }

    private function isTimeToUpdateDB() {
        $lastUpdatedDate = Rate::all('date')->max('date');
        return (Carbon::parse($lastUpdatedDate) < Carbon::today());
    }

    private function updateDB()
    {
        if($this->isTimeToUpdateDB()) {
            try {
                $allCurrency = Parser::getCurrency();
                Rate::updateDB($allCurrency);
            } catch (CurrencyException $e) {
                Session::put('error', $e->getMessage());
            }
        }
    }
}
