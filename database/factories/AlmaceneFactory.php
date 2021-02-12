<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Almacene;
use Faker\Generator as Faker;

$factory->define(Almacene::class, function (Faker $faker) {
    return
    [ 
      'email'     =>$faker->unique()->safeEmail,
      'nombre'    =>$faker->name,
      'direccion' =>$faker->sentence(1),
      'cp'        =>$faker->postcode,
      'isla'      =>$faker->city,
    ];
});
