<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$imgs = [
    '<img src="https://farm5.staticflickr.com/4489/37743618362_594eceff0b_b.jpg" width="640" height="424" alt="Apple tree V1">',
    '<img src="https://farm5.staticflickr.com/4459/37473350250_be9bb89c24_b.jpg" width="640" height="424" alt="Sunrise at red crabs beach">',
    '<img src="https://farm5.staticflickr.com/4514/37473352560_7da215a7a5_z.jpg" width="640" height="424" alt="Follow me">',
    '<img src="https://farm5.staticflickr.com/4494/37473356390_051bb9b747_z.jpg" width="424" height="640" alt="Discrete wheel V1">',
    '<img src="https://farm5.staticflickr.com/4472/37699097482_c20aaa2910_z.jpg" width="640" height="424" alt="Rolling">',
    '<img src="https://farm5.staticflickr.com/4510/37699099812_bc4aa78c5a_z.jpg" width="640" height="424" alt="Fishermen&#x27;s morning V1">',
    '<img src="https://farm5.staticflickr.com/4471/37699101012_7b2c5c2734_z.jpg" width="640" height="424" alt="Dogs on beach V1">',
    '<iframe width="560" height="315" src="https://www.youtube.com/embed/e9dZQelULDk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
    '<iframe width="560" height="315" src="https://www.youtube.com/embed/A-rEb0KuopI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
    '<iframe width="560" height="315" src="https://www.youtube.com/embed/qUGHv2VAESE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
];

$factory->define(App\Blog::class, function (Faker $faker) use ($imgs) {
    return [
    	'title' => $faker->sentence,
        'slug' => $faker->slug,
        'excerpt' => $faker->paragraph,
        'content' => "<p>" . $faker->paragraph . "</p><p>" . $faker->paragraph . "</p><p>" . $faker->paragraph . "</p><p>" . $faker->paragraph . $imgs[array_rand($imgs)] . "</p><p>" . $faker->paragraph . "</p><p>" . $faker->paragraph . "</p><p>" . $faker->paragraph . "</p>",
        // 'content' => $faker->paragraphs(10, $asText = true),
        'user_id' => $faker->randomElement(\DB::table('users')->pluck('id')->toArray()),
        'status' => 1,
        'published_at' => Carbon::Now()->subDays(rand(1, 15))->format('Y-m-d h:i a'),
        'created_at' => Carbon::Now()->subDays(rand(0, 15)),
        'updated_at' => Carbon::Now()->subDays(rand(0, 15)),
    ];
});
