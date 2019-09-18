<?php

use Faker\Generator as Faker;

$factory->define(App\Address::class, function (Faker $faker)
{
    $country_id = $faker->randomElement(\DB::table('countries')->pluck('id')->toArray());
    $state_id = $faker->randomElement(\DB::table('states')->where('country_id', $country_id)->pluck('id')->toArray());

    return [
        'address_title' => $faker->randomElement(['Home Address', 'Office Address', 'Hotel Address', 'Dorm Address']),
        'address_line_1' => $faker->streetAddress,
        'address_line_2' => $faker->streetName,
        'city' => $faker->city,
        'state_id' => $state_id,
        'zip_code' => $faker->postcode,
        'country_id' => $country_id,
        'phone' => $faker->phoneNumber,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
    ];
});
