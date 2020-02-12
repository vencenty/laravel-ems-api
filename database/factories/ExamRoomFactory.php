<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\ExamRoom::class, function (Faker $faker) {
    return [
        'name' => $faker->address ,
        'people_limit' => $faker->numberBetween(0, 300)
    ];
});
