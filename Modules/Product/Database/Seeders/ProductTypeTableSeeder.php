<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-08 11:38:16
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-21 14:50:19
 */

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Product\Entities\ProductType;

/**
 * Class of type Seeder by table ProductType
 * @author Javier Alarcon
 */
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
