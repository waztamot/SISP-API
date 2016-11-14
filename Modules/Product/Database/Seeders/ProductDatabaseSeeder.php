<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

        $this->call(ProductTypeTableSeeder::class); 
        $this->call(ProductTableSeeder::class); 
        //$this->call(ProductPriceTableSeeder::class); 
        $this->call(CombosTableSeeder::class); 
        //$this->call(ComboDetailsTableSeeder::class); 
        $this->call(ComboLapsesTableSeeder::class);
    }
}
