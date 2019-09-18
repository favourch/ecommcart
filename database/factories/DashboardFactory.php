<?php

use Faker\Generator as Faker;

$factory->define(App\Dashboard::class, function (Faker $faker) {
    return [
        'upgrade_plan_notice' => true,
    ];
});
