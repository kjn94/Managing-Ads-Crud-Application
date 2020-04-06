<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Gallery;
use Faker\Generator as Faker;

$factory->define(Gallery::class, function (Faker $faker) {
    $ad_ids = \DB::table('ads')->select('id')->get();
    $ad_id = $faker->randomElement($ad_ids)->id;

    return [
        'ad_id' => $ad_id,
        'filename' => 'noimage.png'
    ];
});
