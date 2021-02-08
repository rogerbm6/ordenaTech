<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cliente;
use Faker\Generator as Faker;

$factory->define(Cliente::class, function (Faker $faker) {
    return
    [
        'nombre'    =>$faker->name,
        'telefono'  =>$faker->phoneNumber,
        'email'     =>$faker->unique()->safeEmail,
        'tipo'      =>$faker->randomElement(['empresa', 'particular']),
    ];
});
