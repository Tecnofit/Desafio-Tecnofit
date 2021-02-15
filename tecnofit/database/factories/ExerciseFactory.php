<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Exercise;
use Faker\Generator as Faker;

$factory->define(Exercise::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
