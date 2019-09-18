<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Coupon::class, function (Faker $faker) {
    return [
        'shop_id' => $faker->randomElement(\DB::table('shops')->pluck('id')->toArray()),
        'name' => $faker->word,
        'code' => $faker->unique->randomNumber(),
        'description' => $faker->text(1500),
        'value' => rand(9, 99),
        'type' => $faker->randomElement(['amount', 'percent']),
        // 'limited' => $faker->boolean,
        'quantity' => rand(1, 100),
        'quantity_per_customer' => rand(1, 5),
        'starting_time' => date('Y-m-d h:i a', strtotime(rand(0, 7) . ' days')),
        'ending_time' => date('Y-m-d h:i a', strtotime(rand(7, 22) . ' days')),
        // 'partial_use' => $faker->boolean,
        // 'exclude_offer_items' => $faker->boolean,
        // 'exclude_tax_n_shipping' => $faker->boolean,
        'created_at' => Carbon::Now()->subDays(rand(0, 15)),
        'updated_at' => Carbon::Now()->subDays(rand(0, 15)),
    ];
});
