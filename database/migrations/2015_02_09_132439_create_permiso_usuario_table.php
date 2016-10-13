<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermisoUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('permiso_usuario', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('permiso_id')->unsigned()->index();
            $table->foreign('permiso_id')->references('id')->on('permisos')->onDelete('cascade');
            $table->string('usuario_id')->index();
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permiso_usuario');
    }
}
