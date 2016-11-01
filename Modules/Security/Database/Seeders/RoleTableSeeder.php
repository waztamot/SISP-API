<?php

namespace Modules\Security\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Security\Entities\Role;
// use Faker\Factory as Faker;

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
      for ($i=1; $i <= 22; $i++) { 
        $admin->attachPermission($i);
      }

      $rrhh = Role::create([
                'name' => 'rrhh',
                'display_name' => 'Talento Humano',
                'description' => 'Talento Humano',
              ]);
      $rrhh->attachPermission(2);   //  Home
      $rrhh->attachPermission(16);  //  Firm
      $rrhh->attachPermission(17);
      $rrhh->attachPermission(18);  //  Product
      $rrhh->attachPermission(19);
      $rrhh->attachPermission(20);
      $rrhh->attachPermission(21);

      $supervisor = Role::create([
                'name' => 'superv',
                'display_name' => 'Supervisor',
                'description' => 'Supervisor',
              ]);
      $supervisor->attachPermission(2);   //  Home
      $supervisor->attachPermission(16);  //  Firm
      $supervisor->attachPermission(17);
      $supervisor->attachPermission(18);  //  Product
      $supervisor->attachPermission(19);
      $supervisor->attachPermission(20);
      $supervisor->attachPermission(21);


      $empleado = Role::create([
                'name' => 'empleado',
                'display_name' => 'Empleado',
                'description' => 'Empleado',
              ]);
      $empleado->attachPermission(16);  //  Firm
      $empleado->attachPermission(17);
      $empleado->attachPermission(18);  //  Product
      $empleado->attachPermission(19);
      $empleado->attachPermission(20);
    }
}
