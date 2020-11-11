<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Cars\Brand;
use Faker\Generator as Faker;

$factory->define(Brand::class, function (Faker $faker) {
    return [
        "name" => "brand " . rand(111111, 9999999)
    ];
});
