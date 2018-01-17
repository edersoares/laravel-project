<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {

    $slug = str_slug($name = $faker->word);

    return [
        'name' => $name,
        'slug' => $slug,
        'boolean' => $faker->boolean,
    ];
});
