<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tariff;
use App\Token;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Token::class, function (Faker $faker) {
    return [
        'name' => 'ApiKey',
        'token' => Str::random(64),
        'abilities' => ['*'],
        'usage' => 0,
        'tariff_id' => function() {
            return Tariff::inRandomOrder()->first()->id;
        },
    ];
});
