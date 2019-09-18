<?php

use Faker\Generator as Faker;

$factory->define(App\Manufacturer::class, function (Faker $faker) {
    return [
        'shop_id' => $faker->randomElement(\DB::table('shops')->pluck('id')->toArray()),
        'name' => $faker->unique->company,
        'slug' => $faker->slug,
        'email' => $faker->unique->email,
        'url' => $faker->unique->url,
        'phone' => $faker->phoneNumber,
        'country_id' => $faker->randomElement(\DB::table('countries')->pluck('id')->toArray()),
        'description' => $faker->text(500),
        'active' => 1,
    ];
});
