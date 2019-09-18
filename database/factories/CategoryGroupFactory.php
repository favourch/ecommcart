<?php

use Faker\Generator as Faker;

$factory->define(App\CategoryGroup::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'slug' => $faker->slug,
        'description' => $faker->text(500),
        'active' => 1,
    ];
});
