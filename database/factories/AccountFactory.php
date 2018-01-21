<?php

use Faker\Generator as Faker;

$factory->define(App\Account::class, function (Faker $faker) {

    $slug = str_slug($name = $faker->company);

    return [
        'name' => $name,
        'slug' => $slug,
        'boolean' => $faker->boolean,
    ];
});
