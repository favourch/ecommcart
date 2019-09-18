<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Banner::class, function (Faker $faker) {
    return [
    	'title' => $faker->randomElement(['Deal of the day', 'Fashion accessories deals', 'Kids item deals', 'Year end SALE!', 'Black Friday Deals!', 'Books category deals', 'Free shipping', 'Tech accessories with free shipping', '80% Off!', 'Everyday essentials deals', 'Save up to 40%']),
        'description' => rand(19, 80) . '% Off Today!',
        'link' => '/category/' . $faker->randomElement(\DB::table('categories')->pluck('slug')->toArray()),
        'link_label' => 'Shop Now',
        'bg_color' => $faker->hexcolor,
        'created_at' => Carbon::Now(),
        'updated_at' => Carbon::Now(),
    ];
});
