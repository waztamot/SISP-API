<?php

namespace Modules\Security\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Security\Entities\Permit;

class PermitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Permit::create([
        'name' => 'security',
        'display_name' => 'Seguridad',
        'description' => 'Permiso para acceder al módulo de seguridad', // optional
      ]);

      Permit::create([
        'name' => 'config',
        'display_name' => 'Configuración',
        'description' => 'Permiso para acceder al módulo de configuración', // optional
      ]);

      Permit::create([
        'name' => 'secret',
        'display_name' => 'Secreto Unico',
        'description' => 'Permiso de un usuario especial', // optional
      ]);

      // Role::create([
      //   'name' => 'admin',
      //   'display_name' => 'Administrador',
      //   'description' => 'Administrador',
      // ]);
    }
}
