<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Dispute::class, function (Faker $faker) {
    $order = $faker->randomElement(\DB::table('orders')->get()->toArray());

    return [
        'dispute_type_id' => rand(1, 7),
        'shop_id' => $order->shop_id,
        'customer_id' => 1,
        'order_id' => $order->id,
        'description' => $faker->text(100),
        'return_goods' => $faker->boolean,
        'order_received' => $faker->boolean,
        'status' => rand(1, 6),
        'created_at' => Carbon::Now()->subMonths(rand(0, 5)),
        'updated_at' => Carbon::Now()->subMonths(rand(0, 5)),
    ];
});
