<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cars\Brand;
use App\Models\Cars\Car;
use Faker\Generator as Faker;

$factory->define(Car::class, function (Faker $faker) {
    return [
        'brand_id' => Brand::all()->random(),
        'current_speed' =>  rand(1111, 9999),
        'avaiable' => $faker->boolean()
    ];
});
