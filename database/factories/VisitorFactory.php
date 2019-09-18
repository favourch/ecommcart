<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Visitor::class, function (Faker $faker) {
	$num2 = rand(1, 999);
    return [
    	'ip' => rand(0,1) == 1 ? $faker->unique()->ipv4 : $faker->unique()->ipv6,
    	'mac' => $faker->unique()->macAddress,
        'hits' => $num2,
        'page_views' => $num2 + rand(0, 999),
        'country_code' => $faker->countryCode,
        'created_at' => Carbon::Now()->subMonths(rand(0, 5)),
        'updated_at' => Carbon::Now()->subMonths(rand(0, 5)),
    ];
});
