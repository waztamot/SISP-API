<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Modules\Seguridad\Entities\Usuario;

class UsuarioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $faker = Faker::create('es_VE');

      $admin = Usuario::create([
                  'id' => $faker->uuid,
                  'cedula' => '666',
                  'nombre' => 'Administrador',
                  'password' => bcrypt('123'),
                ]);

       $admin->attachRole(1);

      $rrhh = Usuario::create([
                'id' => $faker->uuid,
                'cedula' => '02010406',
                'nombre' => 'Talento Humano',
                'password' => bcrypt('123'),
              ]);

       $rrhh->attachRole(2);

      // $supervisor = Usuario::create([
      //           'id' => $faker->uuid,
      //           'cedula' => 'superv',
      //           'nombre' => 'Supervisor',
      //           'password' => bcrypt('123'),
      //         ]);

      // $empleado = Usuario::create([
      //           'id' => $faker->uuid,
      //           'cedula' => 'empleado',
      //           'nombre' => 'Empleado',
      //           'password' => bcrypt('123'),
      //         ]);
   }
 }
