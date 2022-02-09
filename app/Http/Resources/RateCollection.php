<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RateCollection extends ResourceCollection
{


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
            'base' => 'UAH',
            'rates' => $this->collection->map->only([
                'code',
                'name',
                'currency',
                'rate'
            ]),
        ];
//        return parent::toArray($request);
    }
}
