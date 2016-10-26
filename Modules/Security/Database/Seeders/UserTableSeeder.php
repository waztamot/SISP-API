<?php

namespace Modules\Security\Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Modules\Security\Entities\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $faker = Faker::create('es_VE');

      $admin = User::create([
                  'id' => $faker->uuid,
                  'identification' => '666',
                  'name' => 'Administrador',
                  'password' => bcrypt('123'),
                ]);

       $admin->attachRole(1);

      $rrhh = User::create([
                'id' => $faker->uuid,
                // 'identification' => '02010406',
                'identification' => '333',
                'name' => 'Talento Humano',
                'password' => bcrypt('123'),
              ]);

       $rrhh->attachRole(2);

      // $supervisor = User::create([
      //           'id' => $faker->uuid,
      //           'identification' => 'superv',
      //           'name' => 'Supervisor',
      //           'password' => bcrypt('123'),
      //         ]);

      // $empleado = User::create([
      //           'id' => $faker->uuid,
      //           'identification' => 'empleado',
      //           'name' => 'Empleado',
      //           'password' => bcrypt('123'),
      //         ]);
   }
 }
