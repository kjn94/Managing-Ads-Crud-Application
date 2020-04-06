<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ad;
use Faker\Generator as Faker;

$factory->define(Ad::class, function (Faker $faker) {
    $category_ids = \DB::table('categories')->select('id')->get();
    $category_id = $faker->randomElement($category_ids)->id;

    $city_ids = \DB::table('cities')->select('id')->get();
    $city_id = $faker->randomElement($city_ids)->id;

    return [
        'title' => $faker->title,
        'description' => $faker->text(200),
        'price' => $faker->randomNumber(2),
        'main_image' => 'noimage.png',
        //'gallery' => $faker->imageUrl($width = 640, $height = 480),
        'category_id' => $category_id,
        'city_id' => $city_id,
        'active' => $faker->randomElement(array(0,1)),
        'date_expired' => $faker->dateTime(),
        'date_created' => $faker->dateTime(),
        'views' => $faker->randomNumber(2)
    ];
});
