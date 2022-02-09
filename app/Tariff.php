<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    protected $connection = 'mysql';

    public function users()
    {
        return $this->hasMany(Token::class);
    }
}
