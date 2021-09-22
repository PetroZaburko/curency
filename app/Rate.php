<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['r030', 'txt', 'rate', 'cc', 'exchangedate'];

    public static function saveAll($date)
    {
        foreach ($date as $currency) {
            $rate = new static();
            $rate->_id = $currency['r030'];
            $rate->name = $currency['txt'];
            $rate->code = $currency['cc'];
            $rate->rate = $currency['rate'];
            $rate->date = $currency['exchangedate'];
            $rate->save();
        }
    }

    public static function updateDB($date) {
        self::truncate();
        self::saveAll($date);
    }

    public function test()
    {
        return $this->all();
    }
}
