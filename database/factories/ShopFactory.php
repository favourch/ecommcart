<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Shop::class, function (Faker $faker) {
    $company = $faker->unique->company;
    return [
        'owner_id' => $faker->randomElement(\DB::table('users')->where('role_id', 3)->where('id', '!=', 3)->pluck('id')->toArray()),
        'name' => $company,
        'legal_name' => $company,
        'slug' => $faker->slug,
        'email' => $faker->email,
        'description' => $faker->text(500),
        'external_url' => $faker->url,
        'timezone_id' => $faker->randomElement(\DB::table('timezones')->pluck('id')->toArray()),
        'active' => $faker->boolean,
        'created_at' => Carbon::Now()->subDays(rand(0, 15)),
        'updated_at' => Carbon::Now()->subDays(rand(0, 15)),
    ];
});
