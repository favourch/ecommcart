<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Feedback::class, function (Faker $faker) {
	$type = rand(0, 1) == 1 ? 'App\Shop' : 'App\Inventory';
    return [
        'customer_id' => 1,
        'rating' => rand(1, 5),
        'comment' => $faker->paragraph,
        'feedbackable_id' => $type == 'App\Shop' ? 1 : rand(1, 30),
        'feedbackable_type' => $type,
        'created_at' => Carbon::Now()->subDays(rand(0, 15)),
        'updated_at' => Carbon::Now()->subDays(rand(0, 15)),
    ];
});
