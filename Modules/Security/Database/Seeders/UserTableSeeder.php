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
                  'name' => 'Admin Tunal',
                  'password' => bcrypt('123'),
                  'api_token' => str_random(50),
                  'payroll_type' => 0,
                  'company_id' => '1020',
                  'cost_center_id' => '0',
                ]);

      $admin->attachRole(1);

      $rrhh = User::create([
                'id' => $faker->uuid,
                // 'identification' => '02010406',
                'identification' => '333',
                'name' => 'Talento Humano',
                'password' => bcrypt('123'),
                'api_token' => str_random(50),
                'payroll_type' => 14,
                'company_id' => '1020',
                'cost_center_id' => 'A210000200',
              ]);

       $rrhh->attachRole(2);

      // $supervisor = User::create([
      //           'id' => $faker->uuid,
      //           'identification' => 'superv',
      //           'name' => 'Supervisor',
      //           'password' => bcrypt('123'),
      //         ]);

      $empleado = User::create([
                'id' => $faker->uuid,
                'identification' => '999',
                'name' => 'Empleado',
                'password' => bcrypt('123'),
                'api_token' => str_random(50),
                'payroll_type' => 14,
                'company_id' => '1020',
                'cost_center_id' => 'A210000200',
              ]);

      $empleado->attachRole(4);

      $empleado = User::create([
                'id' => $faker->uuid,
                'identification' => '16866530',
                'name' => 'Javier Alarcon',
                'password' => bcrypt('123'),
                'api_token' => str_random(50),
                'payroll_type' => 14,
                'company_id' => '1020',
                'cost_center_id' => 'A210000200',
              ]);

      $empleado->attachRole(4);

      $empleado = User::create([
                'id' => $faker->uuid,
                'identification' => '22264602',
                'name' => 'Oscar Guevara',
                'password' => bcrypt('123'),
                'api_token' => str_random(50),
                'payroll_type' => 14,
                'company_id' => '1020',
                'cost_center_id' => 'A210000200',
              ]);

      $empleado->attachRole(4);

      $empleadoI = User::create([
                'id' => $faker->uuid,
                'identification' => '111',
                'name' => 'Empleado Inactivo',
                'active' => false,
                'password' => bcrypt('123'),
                'api_token' => str_random(50),
                'payroll_type' => 14,
                'company_id' => '1020',
                'cost_center_id' => 'A210000200',
              ]);

      $empleadoI->attachRole(4);

      $empleado = User::create([
                'id' => $faker->uuid,
                'identification' => '000',
                'name' => 'Empleado Sin Permisos',
                'active' => true,
                'password' => bcrypt('123'),
                'api_token' => str_random(50),
                'payroll_type' => 14,
                'company_id' => '1020',
                'cost_center_id' => 'A210000200',
              ]);

      $empleado = User::create([
                'id' => $faker->uuid,
                'identification' => '001',
                'name' => 'Empleado Sin Permisos',
                'active' => true,
                'password' => bcrypt('123'),
                'api_token' => str_random(50),
                'payroll_type' => 14,
                'company_id' => '1020',
                'cost_center_id' => 'A210000200',
              ]);

      $empleado->delete();
   }
 }
