<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\GiftCard::class, function (Faker $faker) {
    $start = rand(-6, 6);
    $end = rand(6, 24);
    $value = rand(10, 100);
    return [
        'name' => $faker->word,
        'description' => $faker->text(1500),
        'value' => $value,
        'remaining_value' => $value - rand(0, $value),
        'serial_number' => $faker->unique->randomNumber(),
        'pin_code' => $faker->unique->randomNumber(),
        'activation_time' => date('Y-m-d h:i a', strtotime($start . ' months')),
        'expiry_time' => date('Y-m-d h:i a', strtotime($end . ' months')),
        'partial_use' => $faker->boolean,
        'exclude_offer_items' => $faker->boolean,
        'exclude_tax_n_shipping' => $faker->boolean,
        'created_at' => Carbon::Now()->subDays(rand(0, 15)),
        'updated_at' => Carbon::Now()->subDays(rand(0, 15)),
    ];
});
