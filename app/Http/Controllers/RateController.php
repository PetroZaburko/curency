<?php

namespace App\Http\Controllers;

use App\Rate;

class RateController extends Controller
{

    public function index()
    {
        $rates = Rate::allLastUpdated();
        $date = $rates->max('created_at')->format('d-m-Y');
        $rates = $rates->toJson(JSON_UNESCAPED_UNICODE);
        return view('content', compact('rates','date'));
    }
}
