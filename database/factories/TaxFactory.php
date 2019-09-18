<?php

use Faker\Generator as Faker;

$factory->define(App\Tax::class, function (Faker $faker) {
    $num = $faker->randomFloat($nbMaxDecimals = NULL, $min = 2, $max = 9);
    $country_id = $faker->randomElement(\DB::table('countries')->pluck('id')->toArray());
    $state_id = $faker->randomElement(\DB::table('states')->where('country_id', $country_id)->pluck('id')->toArray());

    return [
        'shop_id' => $faker->randomElement(\DB::table('shops')->pluck('id')->toArray()),
        'name' => $faker->word . ' ' . round($num, 2) . '%',
        'country_id' => $country_id,
        'state_id' => $state_id,
        'taxrate' => $num,
        'active' => 1,
    ];
});
