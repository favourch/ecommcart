<?php

use Faker\Generator as Faker;

$factory->define(App\ShippingRate::class, function (Faker $faker) {
    $delivery_takes = rand(1,20);
    $based_on = $faker->randomElement(['price', 'weight']);
    return [
        'name' => $faker->word,
        'shipping_zone_id' => rand(1,2),
        'carrier_id' => rand(1,5),
        'delivery_takes' => $delivery_takes . '-' . ( $delivery_takes + rand(1,20) ) . ' days',
        'based_on' => $based_on,
        'minimum' => 0,
        'maximum' => $based_on == 'weight' ? 2000 : Null,
        'rate' => rand(0,20),
    ];
});
