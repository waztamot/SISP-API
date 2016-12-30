<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-10 14:12:57
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-21 13:56:48
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class of type Migration by table ProductPrices
 * @author Javier Alarcon
 */
class CreateProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('company');
            $table->double('price', 20, 2)->unsigned()->default(0);
            $table->integer('quota', 2)->unsigned()->default(1);
            $table->date('valid_from');

            $table->string('product_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_prices');
    }
}
