<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Token;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('password'), // password
        'remember_token' => Str::random(60),
        'locale' => $faker->randomElement(['en', 'ua']),
        'provider' => 'email',
    ];
});

$factory->afterCreating(User::class, function ($user, $faker) {
    $user->tokens()->save(factory(Token::class)->create([
        'tokenable_type' => 'App\User',
        'tokenable_id' => $user->id
    ]));
});
