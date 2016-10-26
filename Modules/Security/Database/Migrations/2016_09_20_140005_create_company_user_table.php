<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_user', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('user_id')->index();
            $table->string('company_id')->index();
            $table->string('cost_center_id')->index();
            $table->boolean('status');

            //  Clave Primaria
            $table->primary(['user_id', 'company_id', 'cost_center_id']);

            //  Relacion de tablas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_user');
    }
}
