<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\InstagramPost;
use App\Models\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'description' => $faker->text,
        'image_path' => $faker->word,
    ];
});
