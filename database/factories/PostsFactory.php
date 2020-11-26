<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Posts;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Posts::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->sentence(3),
        'slug' => Str::random(5).'_'.Str::random(5),
        'content' => $faker->unique()->text,
        'is_published' => $faker->boolean(60),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
