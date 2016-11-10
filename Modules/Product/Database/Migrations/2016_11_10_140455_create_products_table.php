<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('barcode')->unsigned()->nullable();
            $table->string('name');
            $table->string('description');
            $table->boolean('available')->default(true);
            $table->string('image')->nullable();

            $table->integer('product_type_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_type_id')->references('id')->on('product_types')
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
        Schema::dropIfExists('products');
    }
}
