<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Blog;
use Faker\Generator as Faker;
use App\Tag;
use App\Category;

$factory->define(Blog::class, function (Faker $faker) {
    $tags = [factory(Tag::class)->create()->name, factory(Tag::class)->create()->name];
    $categories = [factory(Category::class)->create()->name, factory(Category::class)->create()->name];

    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'author_id' => 1,
        'tags' => $tags,
        'categories' => $categories
    ];
});