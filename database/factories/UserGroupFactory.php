<?php

use Faker\Generator as Faker;

$factory->define(App\UserGroup::class, function (Faker $faker) {

    $slug = str_slug($name = $faker->word);

    return [
        'account_id' => function () {
            return factory(\App\Account::class)->create()->getKey();
        },
        'name' => $name,
        'slug' => $slug,
        'boolean' => $faker->boolean,
    ];
});
