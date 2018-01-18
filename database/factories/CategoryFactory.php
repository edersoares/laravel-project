<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {

    $slug = str_slug($name = $faker->word);

    return [
        'category_id' => null,
        'name' => $name,
        'slug' => $slug,
        'boolean' => $faker->boolean,
    ];
});
