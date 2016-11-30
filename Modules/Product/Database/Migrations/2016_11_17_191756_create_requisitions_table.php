<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequisitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitions', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('identification');
            $table->date('date_requesition');
            $table->string('status')->default('Solicitado');    //  (Solicitado | Aprobado | Rechazado | Entregado)
            $table->string('comment')->nullable();

            $table->string('user_id');
            $table->string('combo_id');
            $table->string('combo_lapse_id');

            $table->timestamps();
            $table->softDeletes();

            $table->primary(['user_id', 'combo_id', 'combo_lapse_id']);

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('combo_id')->references('id')->on('combos')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('combo_lapse_id')->references('id')->on('combo_lapses')
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
        Schema::dropIfExists('requisitions');
    }
}
