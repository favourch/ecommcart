<?php

use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'shop_id' => rand(0, 1) ? 1 : Null,
        'manufacturer_id' => $faker->randomElement(\DB::table('manufacturers')->pluck('id')->toArray()),
        'brand' => $faker->word,
        'name' => $faker->sentence,
        'model_number' => $faker->word .' '.$faker->bothify('??###'),
        'mpn' => $faker->randomNumber(),
        'gtin' => $faker->ean13,
        'gtin_type' => $faker->randomElement(\DB::table('gtin_types')->pluck('name')->toArray()),
        'description' => $faker->text(1500),
        'origin_country' => $faker->randomElement(\DB::table('countries')->pluck('id')->toArray()),
        'has_variant' => $faker->boolean,
        'slug' => $faker->slug,
    	// 'meta_title' => $faker->sentence,
    	// 'meta_description' => $faker->realText,
    	'sale_count' => $faker->randomDigit,
        'active' => 1,
        'created_at' => Carbon::Now()->subDays(rand(0, 15)),
        'updated_at' => Carbon::Now()->subDays(rand(0, 15)),
    ];
});
