<?php

use Faker\Generator as Faker;

$factory->define(App\Airport::class, function (Faker $faker) {
    return [
        'iata' => substr($faker->countryCode, 0, 3),
        'airport' => substr($faker->company, 0, 100),
        'city' => substr($faker->city, 0, 100),
        'state' => strtoupper($faker->randomLetter . $faker->randomLetter),
        'country' => $faker->countryCode,
        'lat' => $faker->latitude,
        'long' => $faker->longitude,
    ];
});
