<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comments;
use Faker\Generator as Faker;

$factory->define(Comments::class, function (Faker $faker) {
    return [
        'content' => $faker->text,
        'is_published' => $faker->boolean(60),
        'user_id' => mt_rand(1,10),
        'post_id' => mt_rand(1,10),
    ];
});
