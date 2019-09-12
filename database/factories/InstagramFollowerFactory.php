<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\InstagramFollower;
use Faker\Generator as Faker;

$factory->define(InstagramFollower::class, function (Faker $faker) {
    return [
        'value' => rand(100, 5000)
    ];
});
