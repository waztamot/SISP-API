<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-08 11:33:59
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-21 13:57:26
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class of type Migration by table ProductTypes
 * @author Javier Alarcon
 */
class CreateProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_types');
    }
}
