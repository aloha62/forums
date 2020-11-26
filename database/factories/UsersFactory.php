<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->unique()->userName,
        'name' => $faker->unique()->name,
        'api_token' => Str::random(60)
    ];
});
