<?php

use Faker\Generator as Faker;

$factory->define(App\Warehouse::class, function (Faker $faker) {
    $shop_id = $faker->randomElement(\DB::table('shops')->pluck('id')->toArray());
    return [
        'shop_id' => $shop_id,
        'incharge' => \DB::table('users')->select('id')->where('shop_id', $shop_id)->first()->id,
        'name' => $faker->company,
        'email' => $faker->email,
        'description' => $faker->text(500),
        'active' => 1,
    ];
});
