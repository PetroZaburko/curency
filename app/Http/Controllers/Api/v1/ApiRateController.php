<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RateCollection;
use App\Http\Resources\RateResource;
use App\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiRateController extends Controller
{
    public function index()
    {
//        return new RateCollection(Rate::allLastUpdated());

        return new RateCollection(Cache::remember('currency', 60*60*24, function (){
            return Rate::allLastUpdated();
        }));
    }


    public function one()
    {
        return new RateResource(Rate::all()->first());
    }
}
