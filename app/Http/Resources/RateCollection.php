<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RateCollection extends ResourceCollection
{
    protected $baseCurrency;

    public function __construct($resource, $baseCurrency = 'UAH')
    {
        parent::__construct($resource);
        $this->baseCurrency = $baseCurrency;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'date' => Carbon::today()->format('d.m.Y'),
            'timestamp' => Carbon::today()->timestamp,
            'base' => $this->baseCurrency,
            'rates' => $this->collection->map->only([
                'iso_code',
                'name',
                'currency_code',
                'rate'
            ]),
        ];
//        return parent::toArray($request);
    }


}
