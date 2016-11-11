<?php

namespace Modules\Product\Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

use Modules\Product\Entities\Combo;

class CombosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_VE');

        $combo_huevos = Combo::create([
                            'id' => $faker->uuid,
                            'company' => '1001',
                            'name' => 'Combo Huevos',
                            'max_quantity' => 1,
                            'concept_paysheet' => '626',
                            'type' => 'Estatico',           // Verificar
                        ]);

        $combo_leches = Combo::create([
                            'id' => $faker->uuid,
                            'company' => '1001',
                            'name' => 'Combo Leche',
                            'max_quantity' => 2,
                            'type' => 'Dinamico',          // Verificar
                        ]);

        $combo_embutidos = Combo::create([
                            'id' => $faker->uuid,
                            'company' => '1001',
                            'name' => 'Combo Embutidos',
                            'max_quantity' => 1,
                            'type' => 'SubCombo',          // Verificar
                        ]);

        $combo_embut1 = Combo::create([
                            'id' => $faker->uuid,
                            'company' => '1001',
                            'name' => 'Combo Embutidos Tipo A - Full',
                            'max_quantity' => 0,
                            'concept_paysheet' => '679',
                            'type' => 'Estatico',          // Verificar
                            'parent_id' => $combo_embutidos->id,
                        ]);

        $combo_embut2 = Combo::create([
                            'id' => $faker->uuid,
                            'company' => '1001',
                            'name' => 'Combo Embutidos Tipo B - Med',
                            'max_quantity' => 0,
                            'concept_paysheet' => '677',
                            'type' => 'Estatico',          // Verificar
                            'parent_id' => $combo_embutidos->id,
                        ]);

        $combo_embut3 = Combo::create([
                            'id' => $faker->uuid,
                            'company' => '1001',
                            'name' => 'Combo Embutidos Tipo C - Peq',
                            'max_quantity' => 0,
                            'concept_paysheet' => '612',
                            'type' => 'Estatico',          // Verificar
                            'parent_id' => $combo_embutidos->id,
                        ]);
    }
}
