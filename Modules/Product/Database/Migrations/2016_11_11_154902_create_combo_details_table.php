<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComboDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_details', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('quantity')->unsigned()->default(0);
            $table->string('unity')->default('Unidad');
            $table->string('concept_paysheet')->nullable();
            $table->integer('quantity_available')->unsigned()->default(0);

            $table->string('combo_id');
            $table->string('product_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('combo_id')->references('id')->on('combos')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('combo_details');
    }
}
