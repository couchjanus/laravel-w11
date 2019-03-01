<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    $user_ids = App\User::pluck('id');
    return [
        'user_id' => $user_ids->random(),
        'name' => $faker->sentence(),
        'price' => $faker->numberBetween(100, 300),
    ];
});
