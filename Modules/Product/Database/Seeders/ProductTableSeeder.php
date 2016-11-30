<?php

namespace Modules\Product\Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductPrice;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('es_VE');

        $product = Product::create([
                        'id' => $faker->uuid,
                        'barcode' => $faker->ean13,
                        'name' => 'Leche Completa', 
                        'description' => 'Leche Completa Purisima UHT',
                        'image' => 'leche_completa.png',
                        'available' => false,
                        'product_type_id' => 1,
                    ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0,999999), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => $product->id,
        ]);

        $product = Product::create([
            'id' => $faker->uuid,
            'barcode' => $faker->ean13,
            'name' => 'Leche Completa',
            'description' => 'Leche Completa Hacienda UHT',
            'image' => 'leche_completa.png',
            'product_type_id' => 1,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0,999999), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => $product->id,
        ]);

        $product = Product::create([
            'id' => $faker->uuid,
            'barcode' => $faker->ean13,
            'name' => 'Leche Descremada',
            'description' => 'Leche Descremada Hacienda UHT',
            'image' => 'leche_descremada.png',
            'product_type_id' => 1,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0,999999), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => $product->id,
        ]);

        $product = Product::create([
            'id' => $faker->uuid,
            'barcode' => $faker->ean13,
            'name' => 'Leche Deslactosada',
            'description' => 'Leche Deslactosada Hacienda UHT',
            'image' => 'leche_deslactosada.png',
            'product_type_id' => 1,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0,999999), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => $product->id,
        ]);

        $product = Product::create([
            'id' => $faker->uuid,
            'barcode' => $faker->ean13,
            'name' => 'Leche Descremda y Deslactosada',
            'description' => 'Leche Descremda y Deslactosada Hacienda UHT',
            'image' => 'leche_descremada_deslactosada.png',
            'product_type_id' => 1,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0,999999), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => $product->id,
        ]);

        $product = Product::create([
            'id' => $faker->uuid,
            'barcode' => $faker->ean13,
            'name' => 'Crema de Leche',
            'description' => 'Crema de Leche Hacienda UHT',
            'product_type_id' => 5,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0,999999), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => $product->id,
        ]);

        $product = Product::create([
            'id' => $faker->uuid,
            'barcode' => $faker->ean13,
            'name' => 'Huevos',
            'description' => 'Huevos El Tunal',
            'image' => 'huevos.png',
            'product_type_id' => 2,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0,999999), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => $product->id,
        ]);

        $product = Product::create([
            'id' => $faker->uuid,
            'barcode' => $faker->ean13,
            'name' => 'Salchicha de Cerdo',
            'description' => 'Salchicha de Cerdo Alimex',
            'image' => 'salchicha_cerdo.png',
            'product_type_id' => 3,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0,999999), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => $product->id,
        ]);

        $product = Product::create([
            'id' => $faker->uuid,
            'barcode' => $faker->ean13,
            'name' => 'Salchicha de Pollo',
            'description' => 'Salchicha de Pollo Alimex',
            'image' => 'salchicha_pollo.png',
            'product_type_id' => 3,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0,999999), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => $product->id,
        ]);

        $product = Product::create([
            'id' => $faker->uuid,
            'barcode' => $faker->ean13,
            'name' => 'Mortadela Caracas',
            'description' => 'Mortadela Caracas de Cerdo Alimex',
            'image' => 'mortadela_cerdo.png',
            'product_type_id' => 3,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0,999999), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => $product->id,
        ]);

        $product = Product::create([
            'id' => $faker->uuid,
            'barcode' => $faker->ean13,
            'name' => 'Mortadela Caracas de Pollo',
            'description' => 'Mortadela Caracas de Pollo Alimex',
            'image' => 'mortadela_pollo.png',
            'product_type_id' => 3,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0,999999), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => $product->id,
        ]);

        $product = Product::create([
            'id' => $faker->uuid,
            'barcode' => $faker->ean13,
            'name' => 'Jamon de Cerdo',
            'description' => 'Jamon de Cerdo Alimex',
            'image' => 'jamon_cerdo.png',
            'product_type_id' => 3,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0,999999), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => $product->id,
        ]);

        $product = Product::create([
            'id' => $faker->uuid,
            'barcode' => $faker->ean13,
            'name' => 'Jamon de Pavo',
            'description' => 'Jamon de Pavo Alimex',
            'image' => 'jamon_pavo.png',
            'product_type_id' => 3,
        ]);

        ProductPrice::create([
            'company' => '1001',
            'price' => $faker->randomFloat(2,0,999999), 
            'valid_from' => $faker->dateTimeBetween('-12 month', 'now', date_default_timezone_get())->format('Y-m-d'),
            'product_id' => $product->id,
        ]);
    }
}
