<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'id' => $faker->randomDigit,
        'name' => $faker->name,
        'address' => $faker->text,
        'website' => $faker->text,
        'introduce' =>$faker->text,
    ];
});
