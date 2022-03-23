<?php

namespace App;

use App\Collections\CustomRateCollection;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Jenssegers\Mongodb\Eloquent\Model;

abstract class Rate extends Model
{
    const UPDATED_AT = null;

    protected $fillable = ['iso_code', 'name', 'currency_code', 'rate', 'date'];

    protected $connection = 'mongodb';


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

    public function allLastUpdated()
    {
        return Cache::remember('currency', 60*60*24, function () {
            return $this->where('created_at', $this->max('created_at')->toDateTime())->get();
        });
    }

    protected function saveAll($collection)
    {
        foreach ($collection as $element) {
            $this->saveOne($element);
        }
    }

    protected function saveOne($element)
    {
        $rate = new static();
        $rate->iso_code = $element->iso_code;
        $rate->name = $element->name;
        $rate->currency_code = $element->currency_code;
        $rate->rate = $element->rate;
        $rate->date = $element->date;
        $rate->save();
    }

    /**
     * @param $object
     * @return boolean
     */
    public abstract function updateDB($object);

}
