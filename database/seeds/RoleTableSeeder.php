<?php

use Illuminate\Database\Seeder;
// use Faker\Factory as Faker;
use SISP\Entities\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // $faker = Faker::create('es_VE');

      $admin = Role::create([
                'name' => 'admin',
                'display_name' => 'Administrador',
                'description' => 'Todopoderoso',
              ]);

      $admin->attachPermission(1);
      $admin->attachPermission(2);

      $rrhh = Role::create([
                'name' => 'rrhh',
                'display_name' => 'Talento Humano',
                'description' => 'Talento Humano',
              ]);
      $rrhh->attachPermission(1);
      $rrhh->attachPermission(2);



      $supervisor = Role::create([
                'name' => 'superv',
                'display_name' => 'Supervisor',
                'description' => 'Supervisor',
              ]);
      $supervisor->attachPermission(1);
      $supervisor->attachPermission(2);


      $empleado = Role::create([
                'name' => 'empleado',
                'display_name' => 'Empleado',
                'description' => 'Empleado',
              ]);
      $empleado->attachPermission(1);
      $empleado->attachPermission(2);

    }
}
