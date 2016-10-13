<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(SISP\Entities\Usuario::class, function (Faker\Generator $faker) {
  static $password;
    return [
        'id' => $faker->uuid,
        'cedula' => $faker->randomNumber($nbDigits = 8),
        'nombre' => $faker->name,
        'password' => $password ?: $password = bcrypt('secret'),
        ];
      });

$factory->define(SISP\Entities\Role::class, function (Faker\Generator $faker) {
  $name = $faker->word;
  
  return [
    'name' => $name,
    'slug' => str_slug($name, '-'),
    'description' => '** Rol de prueba **',
  ];
});

$factory->define(SISP\Entities\Permiso::class, function (Faker\Generator $faker) {
  $name = $faker->word.' '.$faker->word;

  return [
    'name' => $name,
    'slug' => str_slug($name, '.'),
    'description' => '** Permiso de prueba **',
  ];
});
