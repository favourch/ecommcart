<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Ticket::class, function (Faker $faker) {
    return [
        'shop_id' => $faker->randomElement(\DB::table('shops')->pluck('id')->toArray()),
        'user_id' => 3,
        'category_id' => $faker->randomElement(\DB::table('ticket_categories')->pluck('id')->toArray()),
        'subject' => $faker->sentence,
        'message' => $faker->paragraph,
        'status' => rand(1, 6),
        'priority' => rand(1, 4),
        'created_at' => Carbon::Now()->subDays(rand(0, 15)),
        'updated_at' => Carbon::Now()->subDays(rand(0, 15)),
    ];
});
