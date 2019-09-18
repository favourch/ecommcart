<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Customer::class, function (Faker $faker) {
    return [
        'nice_name' => $faker->lastName,
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(123456),
        'dob' => $faker->date,
        'sex' => $faker->randomElement(['app.male', 'app.female', 'app.other']),
        'description' => $faker->text(500),
        'active' => $faker->boolean,
        'remember_token' => str_random(10),
        'verification_token' => rand(0,1) == 1 ? Null : str_random(10),
        'created_at' => Carbon::Now()->subDays(rand(0, 15)),
        'updated_at' => Carbon::Now()->subDays(rand(0, 15)),
    ];
});
