<?php

use Faker\Generator as Faker;

$factory->define(App\CategorySubGroup::class, function (Faker $faker) {
    return [
        'category_group_id' => $faker->randomElement(\DB::table('category_groups')->pluck('id')->toArray()),
        'name' => $faker->company,
        'slug' => $faker->slug,
        'description' => $faker->text(500),
        'active' => 1,
    ];
});
