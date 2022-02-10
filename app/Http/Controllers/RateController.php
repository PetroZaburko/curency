<?php

namespace App\Http\Controllers;

use App\Rate;
use App\Services\CurrencyIterator;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class RateController extends Controller
{

    public function index(CurrencyIterator $iterator)
    {
        Rate::updateDB($iterator);
        $rates = Rate::allLastUpdated();
        $date = $rates->max('created_at')->format('d-m-Y');
        $rates = $rates->toJson(JSON_UNESCAPED_UNICODE);
        return view('content', compact('rates','date'));
    }

}
