<?php

use Faker\Generator as Faker;

$factory->define(App\Note::class, function (Faker $faker) {
    return [

        'user_id'=>function(){
            return factory('App\User')->create()->id;
        },
        'title' => $faker->text(40),
        'note' => $faker->text(500)
    ];
});
