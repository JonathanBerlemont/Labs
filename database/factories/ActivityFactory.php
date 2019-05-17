<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Activity;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'description' => $faker->randomElement(['created', 'deleted', 'updated']),
        'subject_id' => factory($faker->randomElement(['App\Blog', 'App\User']))->create()->id,
        'subject_type' => $faker->randomElement(['App\Blog', 'App\User']),
        'subject_name' => $faker->sentence
    ];
});
