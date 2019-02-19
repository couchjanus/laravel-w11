<?php

use Faker\Generator as Faker;
use \Cviebrock\EloquentSluggable\Services\SlugService;

$factory->define(App\Post::class, function (Faker $faker) {
    $user_ids = App\User::pluck('id');
    $category_ids = App\Category::pluck('id');
    $title = $faker->sentence();
    return [
       'title' => $title,
       'slug' => SlugService::createSlug(App\Post::class, 'slug', $title),
       'content' => $faker->paragraph(20),
       'user_id' => $user_ids->random(),
       'category_id' => $category_ids->random(),
       'status' => $faker->numberBetween(0, 3),
    ];
});
