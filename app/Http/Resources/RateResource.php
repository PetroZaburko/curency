<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'date' => Carbon::today()->format('d.m.Y'),
            'base' => 'UAH',
            'rate' => [
                'code' => $this->code,
                'name' => $this->name,
                'currency' => $this->currency,
                'rate' => $this->rate
            ]
        ];
    }
}
