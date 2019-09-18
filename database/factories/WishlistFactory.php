<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Wishlist::class, function (Faker $faker) {
    $inventory = $faker->randomElement(\DB::table('inventories')->select('product_id','id')->get()->toArray());
    // $inventory_id = $faker->randomElement(\DB::table('inventories')->pluck('id')->toArray());
    $time = Carbon::Now()->subDays(rand(0, 15));
    return [
        'customer_id' => 1,
        'product_id' => $inventory->product_id,
        'inventory_id' => $inventory->id,
        'created_at' => $time,
        'updated_at' => $time,
    ];
});
