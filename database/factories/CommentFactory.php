<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Comment;
use App\Blog;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'blog_id' => function () {
            return factory(Blog::class)->create()->id;
        },
        'subject' => $faker->sentence,
        'message' => $faker->paragraph,
        'email' => $faker->email,
    ];
});
