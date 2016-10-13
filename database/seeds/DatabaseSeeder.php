<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermisoTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UsuarioTableSeeder::class);
    }
}
