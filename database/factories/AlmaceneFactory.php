<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Almacene;
use Faker\Generator as Faker;

$factory->define(Almacene::class, function (Faker $faker) {
    return
    [
      'nombre'    =>$faker->name,
      'direccion' =>$faker->sentence(1),
      'cp'        =>$faker->postcode,
      'isla'      =>$faker->city,
    ];
});
