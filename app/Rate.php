<?php

namespace App;

use App\Services\Currency;
use Carbon\Carbon;
use App\Services\CurrencyCollection;
use Jenssegers\Mongodb\Eloquent\Model;

class Rate extends Model
{
    const UPDATED_AT = null;

    protected $fillable = ['code', 'name', 'currency', 'rate', 'date'];
    protected $connection = 'mongodb';


    public function setCreatedAt($value)
    {
        $this->created_at = Carbon::now()->second(0);
        return $this;
    }

    public static function allLastUpdated()
    {
        return self::where('created_at', self::max('created_at')->toDateTime())->get();
    }

    public static function saveAll(CurrencyCollection $collection)
    {
        foreach ($collection as $element) {
            self::saveOne($element);
        }
    }

    protected static function saveOne(Currency $element)
    {
        $rate = new static();
        $rate->code = $element->getCode();
        $rate->name = $element->getName();
        $rate->currency = $element->getCurrency();
        $rate->rate = $element->getRate();
        $rate->date = $element->getDate();
        $rate->save();
    }
}
