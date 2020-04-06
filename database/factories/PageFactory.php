<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'text' => $faker->text,
        'slug' => $faker->slug,
        'page_image' => 'noimage.png',
    ];
});
