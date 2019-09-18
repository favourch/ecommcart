<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\BlogComment::class, function (Faker $faker) {
    return [
        'blog_id' => $faker->randomElement(\DB::table('blogs')->pluck('id')->toArray()),
        'content' => $faker->paragraph,
        'user_id' => $faker->randomElement(\DB::table('users')->pluck('id')->toArray()),
        'approved' => $faker->boolean,
        'created_at' => Carbon::Now()->subDays(rand(0, 15)),
        'updated_at' => Carbon::Now()->subDays(rand(0, 15)),
    ];
});
