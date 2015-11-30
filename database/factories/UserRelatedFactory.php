<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Ccusa\User\User::class, function (Faker\Generator $faker) {
    return [
        'username' => $faker->userName,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
    ];
});
