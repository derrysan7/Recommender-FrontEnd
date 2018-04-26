<?php

use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {
    return [
        'item_mat_id' => $faker->randomNumber(6),
        'item_id'     => $faker->word(11),
        'title' 	  => $faker->text(50)
    ];
});
