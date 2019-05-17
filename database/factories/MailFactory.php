<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Mail;
use Faker\Generator as Faker;

$factory->define(Mail::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'subject' => $faker->sentence,
        'message' => $faker->paragraph,
        'read' => $faker->randomElement([0, 1])
    ];
});
