<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    $user_ids = App\User::pluck('id');
    $post_ids = App\Post::pluck('id');
   
    return [
        'body' => $faker->sentence(),
        'creator_id' => $user_ids->random(),
        'creator_type' => 'App\User',
        'commentable_id' => $post_ids->random(),
        'commentable_type' => 'App\Post' 
    ];
});
