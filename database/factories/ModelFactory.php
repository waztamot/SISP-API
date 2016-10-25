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

/*$factory->define(Modules\Seguridad\Entities\User::class, function (Faker\Generator $faker) {
  static $password;
    return [
        'id' => $faker->uuid,
        'identification' => $faker->randomNumber($nbDigits = 8),
        'name' => $faker->name,
        'password' => $password ?: $password = bcrypt('secret'),
        ];
      });

$factory->define(Modules\Seguridad\Entities\Role::class, function (Faker\Generator $faker) {
  $name = $faker->word;
  
  return [
    'name' => $name,
    'slug' => str_slug($name, '-'),
    'description' => '** Rol de prueba **',
  ];
});

$factory->define(Modules\Seguridad\Entities\Permission::class, function (Faker\Generator $faker) {
  $name = $faker->word.' '.$faker->word;

  return [
    'name' => $name,
    'slug' => str_slug($name, '.'),
    'description' => '** Permiso de prueba **',
  ];
});*/
