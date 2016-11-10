<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Product\Entities\ProductType;

class ProductTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductType::create([
            'name' => 'Leche',
            'description' => 'Leche',
            ]);

        ProductType::create([
            'name' => 'Huevo',
            'description' => 'Huevo',
            ]);

        ProductType::create([
            'name' => 'Embutidos',
            'description' => 'Embutidos',
            ]);

        ProductType::create([
            'name' => 'Jugos',
            'description' => 'Jugos',
            ]);

        ProductType::create([
            'name' => 'Derivados Lacteos',
            'description' => 'Derivados Lacteos',
            ]);
    }
}
