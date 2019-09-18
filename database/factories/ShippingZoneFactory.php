<?php

use Faker\Generator as Faker;

$factory->define(App\ShippingZone::class, function (Faker $faker) {
    $country_ids = $faker->randomElements( \DB::table('countries')->pluck('id')->toArray(), 3 );
    $state_ids = \DB::table('states')->whereIn('country_id', $country_ids)->pluck('id')->toArray();
    return [
        'name' => 'Domestic',
        'tax_id' => 1,
        'country_ids' => $country_ids,
        'state_ids' => $state_ids,
    ];
});
