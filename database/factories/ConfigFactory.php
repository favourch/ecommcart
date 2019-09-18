<?php

use Faker\Generator as Faker;

$factory->define(App\Config::class, function (Faker $faker) {
    return [
        'support_email' => $faker->email,
        'default_sender_email_address' => $faker->email,
        'default_email_sender_name' => $faker->name,
        'support_phone' => $faker->phoneNumber,
        'support_phone_toll_free' => $faker->boolean ? $faker->tollFreePhoneNumber : NULL,
        'order_number_prefix' => '#',
        'default_tax_id' => rand(1, 31),
        'default_packaging_ids' => array_rand(range(1,30), rand(1,4)),
        'order_handling_cost' => rand(0, 1) ? rand(1, 5) : Null,
        'maintenance_mode' => $faker->boolean,
    ];
});
