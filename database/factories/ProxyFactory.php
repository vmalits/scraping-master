<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Proxy;
use Faker\Generator as Faker;

$factory->define(Proxy::class, function (Faker $faker) {
    return [
        'type' => Proxy::TYPES[array_rand(Proxy::TYPES)],
        'ip' => $faker->ipv4,
        'port' => random_int(20, 6000)
    ];
});
