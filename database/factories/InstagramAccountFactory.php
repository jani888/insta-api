<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\InstagramAccount;
use Faker\Generator as Faker;

$factory->define(InstagramAccount::class, function (Faker $faker) {
    return [
        'username' => $faker->userName,
        'full_name' => $faker->name,
        'instagram_id' => rand(0, 100000000),
    ];
});
