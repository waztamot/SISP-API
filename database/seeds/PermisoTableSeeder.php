<?php

use Illuminate\Database\Seeder;
use Modules\Seguridad\Entities\Permiso;

class PermisoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Permiso::create([
        'name' => 'security',
        'display_name' => 'Seguridad',
        'description' => 'Permiso para acceder al módulo de seguridad', // optional
      ]);

      Permiso::create([
        'name' => 'config',
        'display_name' => 'Configuración',
        'description' => 'Permiso para acceder al módulo de configuración', // optional
      ]);

      Permiso::create([
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
