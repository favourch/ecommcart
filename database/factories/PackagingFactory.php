<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Packaging::class, function (Faker $faker) {
    return [
        'shop_id' => $faker->randomElement(\DB::table('shops')->pluck('id')->toArray()),
        'name' => $faker->word,
        'cost' => rand(1,10),
        'width' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 50),
        'height' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 60),
        'depth' => $faker->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 40),
        'created_at' => Carbon::Now()->subDays(rand(0, 15)),
        'updated_at' => Carbon::Now()->subDays(rand(0, 15)),
    ];
});
