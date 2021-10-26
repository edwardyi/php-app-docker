<?php

use edwardyi\Press\Post;
use Faker\Generator;
use Illuminate\Support\Str;

$factory->define(Post::class, function(Generator $faker) {
    return [
        'identifier' => Str::random(),
        'slug' => Str::slug($faker->sentence),
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'extra' => json_encode(['test' => 'value'])
    ];
});