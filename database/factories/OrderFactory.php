<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {
    $num = $faker->randomFloat($nbMaxDecimals = NULL, $min = 100, $max = 400);
    $num1 = $faker->randomFloat($nbMaxDecimals = NULL, $min = 100, $max = 400);
    $num2 = rand(1,9);
    // $customer_id = $faker->randomElement(\DB::table('customers')->pluck('id')->toArray());
    $customer_id = 1;
    // $billing_address = \DB::table('addresses')->where('addressable_type', 'App\Customer')->where('addressable_id', $customer_id)->first()->id;
    $billing_address = App\Address::where('addressable_type', 'App\Customer')->where('addressable_id', $customer_id)->first()->toHtml('<br/>', false);

    return [
        'shop_id' => $faker->randomElement(\DB::table('shops')->pluck('id')->toArray()),
        'order_number' => '#' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
        'customer_id' => $customer_id,
        'shipping_rate_id' => $faker->randomElement(\DB::table('shipping_rates')->pluck('id')->toArray()),
        'packaging_id' => $faker->randomElement(\DB::table('packagings')->pluck('id')->toArray()),
        'item_count' => $num2,
        'quantity' => $num2,
        'shipping_weight' => rand(100,999),
        'total' => $num,
        'shipping' => $num2,
        'grand_total' => $num2 + $num,
        'billing_address' => $billing_address,
        'shipping_address' => $billing_address,
        'tracking_id' => 'RR123456789CN',
        'payment_method_id' => $faker->randomElement(\DB::table('payment_methods')->pluck('id')->toArray()),
        'payment_status' => rand(1, 3),
        'admin_note' => $faker->sentence,
        'buyer_note' => $faker->sentence,
        'created_at' => Carbon::Now()->subDays(rand(0, 15)),
        'updated_at' => Carbon::Now()->subDays(rand(0, 15)),
    ];
});
