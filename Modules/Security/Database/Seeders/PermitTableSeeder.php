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
        'name' => 'security.home',
        'display_name' => 'Seguridad - Inicio',
        'description' => 'Permiso inicio de la app', // optional
      ]);

      Permit::create([
        'name' => 'security.config',
        'display_name' => 'Seguridad - Configuración',
        'description' => 'Permiso para acceder a la configuración del módulo de seguridad', // optional
      ]);

      Permit::create([
        'name' => 'security.permits',
        'display_name' => 'Seguridad - Permisos',
        'description' => 'Acceso para gestionar los permisos de los usuarios en la app', // optional
      ]);

      Permit::create([
        'name' => 'security.permits.create',
        'display_name' => 'Seguridad - Permisos(Crear)',
        'description' => 'Acceso para crear los permisos de los usuarios en la app', // optional
      ]);

      Permit::create([
        'name' => 'security.permits.edit',
        'display_name' => 'Seguridad - Permisos(Editar)',
        'description' => 'Acceso para editar los permisos de los usuarios en la app', // optional
      ]);

      Permit::create([
        'name' => 'security.permits.delete',
        'display_name' => 'Seguridad - Permisos(Eliminar)',
        'description' => 'Acceso para eliminar los permisos de los usuarios en la app', // optional
      ]);

      Permit::create([
        'name' => 'security.roles',
        'display_name' => 'Seguridad - Roles',
        'description' => 'Acceso para gestionar los roles de los usuarios en la app', // optional
      ]);

      Permit::create([
        'name' => 'security.roles.create',
        'display_name' => 'Seguridad - Roles(Crear)',
        'description' => 'Acceso para crear los roles de los usuarios en la app', // optional
      ]);

      Permit::create([
        'name' => 'security.roles.edit',
        'display_name' => 'Seguridad - Roles(Editar)',
        'description' => 'Acceso para editar los roles de los usuarios en la app', // optional
      ]);

      Permit::create([
        'name' => 'security.roles.delete',
        'display_name' => 'Seguridad - Roles(Eliminar)',
        'description' => 'Acceso para eliminar los roles de los usuarios en la app', // optional
      ]);

      Permit::create([
        'name' => 'security.password_change',
        'display_name' => 'Seguridad - Cambio Clave',
        'description' => 'Permiso para cambio de clave del usuario', // optional
      ]);

      Permit::create([
        'name' => 'security.forgotten_password',
        'display_name' => 'Seguridad - Olvido Clave',
        'description' => 'Permiso para olvido la clave del usuario', // optional
      ]);

      Permit::create([
        'name' => 'security.users_management',
        'display_name' => 'Seguridad - Manejo Usuarios',
        'description' => 'Permiso para gestionar usuarios en la app', // optional
      ]);

      Permit::create([
        'name' => 'config',
        'display_name' => 'Configuración',
        'description' => 'Permiso para acceder al módulo de configuración', // optional
      ]);

      Permit::create([
        'name' => 'firm',
        'display_name' => 'Firma',
        'description' => 'Permiso para acceder al módulo de Firma', // optional
      ]);

      Permit::create([
        'name' => 'firm.home',
        'display_name' => 'Firma - Inicio',
        'description' => 'Permiso de inicio al módulo firma de la app', // optional
      ]);

      Permit::create([
        'name' => 'product',
        'display_name' => 'Producto',
        'description' => 'Permiso para acceder al módulo de productos', // optional
      ]);

      Permit::create([
        'name' => 'product.home',
        'display_name' => 'Producto - Inicio',
        'description' => 'Permiso de inicio al módulo productos de la app', // optional
      ]);

      Permit::create([
        'name' => 'product.requested',
        'display_name' => 'Producto - Pedido',
        'description' => 'Permiso para gestionar pedidos individuales de productos', // optional
      ]);

      Permit::create([
        'name' => 'product.group_requested',
        'display_name' => 'Producto - Pedido Grupal',
        'description' => 'Permiso para gestionar pedidos grupales de productos', // optional
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
