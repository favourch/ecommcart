<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'category_sub_group_id' => $faker->randomElement(\DB::table('category_sub_groups')->pluck('id')->toArray()),
        'name' => $faker->unique->company,
        'slug' => $faker->slug,
        'description' => $faker->text(80),
        'active' => 1,
    ];
});
