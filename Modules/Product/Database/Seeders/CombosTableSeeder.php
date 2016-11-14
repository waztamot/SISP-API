<?php

namespace Modules\Product\Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Product\Entities\Combo;
use Modules\Product\Entities\ComboDetail;
use Modules\Product\Repositories\ProductRepository;

class CombosTableSeeder extends Seeder
{


    protected $productsRepo;

    public function __construct(ProductRepository $productsRepo) 
    {
        $this->productsRepo = $productsRepo;
    }

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
                            'type' => 'Estatico',           //  Verificar
                        ]);

        $products = $this->productsRepo->getActiveWhere([
            ['available', '=', true],
            ['product_type_id', '=', 2],                    //  Huevo
        ]);

        foreach ($products as $key => $value) {
            ComboDetail::create([
                'id' => $faker->uuid,
                'quantity' => 4,
                'unity' => 'Carton',
                'quantity_available' => 5000,
                'combo_id' => $combo_huevos->id,
                'product_id' => $value->id,
            ]);
        }

        $combo_leches = Combo::create([
                            'id' => $faker->uuid,
                            'company' => '1001',
                            'name' => 'Combo Leche',
                            'max_quantity' => 2,
                            'type' => 'Dinamico',           //  Verificar
                        ]);

        $products = $this->productsRepo->getActiveWhere([
            ['available', '=', true],
            ['product_type_id', '=', 1],                    //  Leche
        ]);

        foreach ($products as $key => $value) {
            ComboDetail::create([
                'id' => $faker->uuid,
                'quantity' => 0,
                'unity' => 'Caja',
                'concept_paysheet' => '682',
                'quantity_available' => 5000,
                'combo_id' => $combo_leches->id,
                'product_id' => $value->id,
            ]);
        }

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
        $products = $this->productsRepo->getActiveWhere([
            ['available', '=', true],
            ['product_type_id', '=', 3],                    //  Embutidos
        ]);

        foreach ($products as $key => $value) {
            ComboDetail::create([
                'id' => $faker->uuid,
                'quantity' => 1,
                'unity' => 'Unidad',
                'quantity_available' => 5000,
                'combo_id' => $combo_embut1->id,
                'product_id' => $value->id,
            ]);
        }

        $combo_embut2 = Combo::create([
                            'id' => $faker->uuid,
                            'company' => '1001',
                            'name' => 'Combo Embutidos Tipo B - Med',
                            'max_quantity' => 0,
                            'concept_paysheet' => '677',
                            'type' => 'Estatico',          // Verificar
                            'parent_id' => $combo_embutidos->id,
                        ]);

        $products = $this->productsRepo->getActiveWhere([
            ['available', '=', true],
            ['product_type_id', '=', 3],                    //  Embutidos
        ]);

        foreach ($products as $key => $value) {
            ComboDetail::create([
                'id' => $faker->uuid,
                'quantity' => 1,
                'unity' => 'Unidad',
                'quantity_available' => 5000,
                'combo_id' => $combo_embut2->id,
                'product_id' => $value->id,
            ]);
        }

        $combo_embut3 = Combo::create([
                            'id' => $faker->uuid,
                            'company' => '1001',
                            'name' => 'Combo Embutidos Tipo C - Peq',
                            'max_quantity' => 0,
                            'concept_paysheet' => '612',
                            'type' => 'Estatico',          // Verificar
                            'parent_id' => $combo_embutidos->id,
                        ]);

        $products = $this->productsRepo->getActiveWhere([
            ['available', '=', true],
            ['product_type_id', '=', 3],                    //  Embutidos
        ]);

        foreach ($products as $key => $value) {
            ComboDetail::create([
                'id' => $faker->uuid,
                'quantity' => 1,
                'unity' => 'Unidad',
                'quantity_available' => 5000,
                'combo_id' => $combo_embut3->id,
                'product_id' => $value->id,
            ]);
        }
    }
}
