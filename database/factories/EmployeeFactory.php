<?php

use Faker\Generator as Faker;

$factory->define(\App\Employee::class, function (Faker $faker) {
    return [
        'username' => $faker->ein,
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt('123456'),
        'is_reset' => 0,
        'status' => 0,
        'user_id' => \App\User::all()->random(),
        'position_id' => \App\Position::all()->random(),
    ];
});
