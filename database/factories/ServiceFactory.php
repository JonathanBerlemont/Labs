<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Service;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    return [
        'icon_class' => 'flaticon-008-team',
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
    ];
});
