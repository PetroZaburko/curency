<?php

namespace App;

use App\Collections\CustomRateCollection;
use App\Exceptions\CurrencyException;
use App\Services\Currency;
use App\Services\CurrencyIterator;
use Carbon\Carbon;
use App\Services\CurrencyCollection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Jenssegers\Mongodb\Eloquent\Model;

class Rate extends Model
{
    const UPDATED_AT = null;

    protected $fillable = ['iso_code', 'name', 'currency_code', 'rate', 'date'];
    protected $connection = 'mongodb';

//    protected $casts = [
//        'iso_code' => 'integer',
//        'name' => 'string',
//        'currency_code' => 'string',
//        'rate' => 'float',
//        'date' => 'string',
//        'created_at' => 'datetime:Y-m-d H:i'
//    ];


    public function setCreatedAt($value)
    {
        $this->created_at = Carbon::now()->second(0);
        return $this;
    }

    public function newCollection(array $models = [])
    {
        return new CustomRateCollection($models);
    }

    public function setCurrencyCodeAttribute($value)
    {
        $this->attributes['currency_code'] = strtoupper($value);
    }

    public static function allLastUpdated()
    {
        return Cache::remember('currency', 60*60*24, function () {
            return self::where('created_at', self::max('created_at')->toDateTime())->get();
        });
    }

    protected static function saveAll(CurrencyCollection $collection)
    {
        foreach ($collection as $element) {
            self::saveOne($element);
        }
    }

    protected static function saveOne(Currency $element)
    {
        $rate = new static();
        $rate->iso_code = $element->getIsoCode();
        $rate->name = $element->getName();
        $rate->currency_code = $element->getCurrencyCode();
        $rate->rate = $element->getRate();
        $rate->date = $element->getDate();
        $rate->save();
    }

    public static function updateDB(CurrencyIterator $iterator)
    {
        if(self::isTimeToUpdateDB()) {
            try {
                $allCurrency = $iterator->exchange()->getCurrency();
                self::saveAll($allCurrency);
            } catch (CurrencyException $e) {
                Session::put('error', $e->getMessage());
            }
        }
    }

    protected static function isTimeToUpdateDB()
    {
//        return true;
        if ($maxDate = self::max('created_at')) {
            return $maxDate->toDateTime() < Carbon::today()->toDateTime();
        }
        return true;
    }


}
