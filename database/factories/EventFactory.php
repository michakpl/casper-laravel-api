<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Event::class, function (Faker $faker) {
    return [
        'user_id'   => \DB::table('users')->first()->id,
        'title' => $faker->sentence(),
        'location' => $faker->address,
        'location_geo' => null,
        'description' => $faker->paragraphs(3, true),
        'starts_at' => $faker->dateTimeBetween('now', '+1 year'),
        'duration' => $faker->randomNumber(2),
        'guests_limit' => $faker->randomNumber(3),
        'registration_ends_at' => $faker->dateTimeBetween('-1 month', '+1 year'),
        'is_private' => $faker->boolean
    ];
});
