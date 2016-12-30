<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-10 14:31:17
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-30 08:59:18
 */

namespace Modules\Product\Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Product\Entities\ProductPrice;

/**
 * Class of type Seeder by table ProductPrice
 * @author Javier Alarcon
 */
class ProductPriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
/*        $faker = Faker::create('es_VE');

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => 2,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => 3,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => 4,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => 5,
        ]);*/
    }
}
