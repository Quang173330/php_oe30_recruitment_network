<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text,
        'experience' => $faker->text,
        'salary' => $faker->text,
        'status' => 1,
    ];
});
