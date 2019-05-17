<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Testimonial;
use Faker\Generator as Faker;

$factory->define(Testimonial::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'job' => $faker->word,
        'message' => $faker->paragraph
    ];
});
