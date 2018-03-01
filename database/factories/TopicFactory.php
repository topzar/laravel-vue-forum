<?php

use Faker\Generator as Faker;

$factory->define(\App\Topic::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'bio' => $faker->paragraph,
        'questions_count' => 1
    ];
});
