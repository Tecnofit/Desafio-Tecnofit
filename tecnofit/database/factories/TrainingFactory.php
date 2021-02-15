<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Training;
use App\Models\User;
use App\Models\Exercise;
use Faker\Generator as Faker;

$factory->define(Training::class, function (Faker $faker) {
    return [
        'user_id'     => function() { return factory(User::class)->create()->id;},
        'exercise_id' => function() {return factory(Exercise::class)->create()->id;},
        'sessions'    => $faker->numberBetween($min = 1, $max = 200),
        'status'      => $faker->randomElement([null ,'skipped', 'completed']),
        'active'      => $faker->boolean(50)
    ];
});

