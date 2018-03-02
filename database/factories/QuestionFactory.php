<?php

use Faker\Generator as Faker;

$factory->define(\App\Question::class, function (Faker $faker) {

    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => rand(1,11)
    ];
});
