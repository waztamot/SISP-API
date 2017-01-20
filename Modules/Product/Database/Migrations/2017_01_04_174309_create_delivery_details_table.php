<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_details', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->decimal('weight')->default(0);
            $table->integer('quantity')->default(0);
            $table->string('unity')->default('Unidad');

            $table->string('delivery_id');
            $table->string('combo_id');
            $table->string('product_id');

            $table->timestamps();

            $table->foreign('delivery_id')->references('id')->on('deliveries')->onDelete('cascade');
            $table->foreign('combo_id')->references('id')->on('combos')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_details');
    }
}
