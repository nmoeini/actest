<?php

use Faker\Generator as Faker;

$factory->define(App\Note::class, function (Faker $faker) {
    return [
            'title' => $faker->text(40),
            'note' => $faker->text(500)
    ];
});
