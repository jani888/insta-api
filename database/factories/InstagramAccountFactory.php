<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\InstagramAccount;
use Faker\Generator as Faker;

$factory->define(InstagramAccount::class, function (Faker $faker) {
    return [
        'id' => rand(1, 1000000),
        'username' => $faker->userName,
        'full_name' => $faker->name,
    ];
});
