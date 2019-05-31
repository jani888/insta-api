<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'description' => $faker->text,
        'likes' => rand(0, 15000),
        'shortcode' => Str::random(8),
        'instagram_account_id' => factory(\App\Models\InstagramAccount::class)->create()->id,
    ];
});
