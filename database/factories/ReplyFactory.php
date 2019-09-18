<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Reply::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement(\DB::table('users')->pluck('id')->toArray()),
        'reply' => $faker->paragraph,
        'read' => $faker->boolean,
        'repliable_id' => rand(1, 5),
        'repliable_type' => rand(0, 1) == 1 ? 'App\Ticket' : 'App\Message',
        'created_at' => Carbon::Now()->subDays(rand(0, 15)),
        'updated_at' => Carbon::Now()->subDays(rand(0, 15)),
    ];
});
