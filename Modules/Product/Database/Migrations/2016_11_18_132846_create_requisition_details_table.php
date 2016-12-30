<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisition_details', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->integer('quantity')->unsigned()->default(0);
            $table->double('amount', 20, 2)->unsigned()->default(0);

            $table->string('requisition_id');
            $table->string('product_id');
            $table->string('combo_id');

            $table->timestamps();
            // $table->softDeletes();

            $table->foreign('requisition_id')->references('id')->on('requisitions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('combo_id')->references('id')->on('combos')
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
        Schema::dropIfExists('requisition_details');
    }
}
