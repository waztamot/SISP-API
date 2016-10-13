<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa_usuario', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('usuario_id')->index();
            $table->string('empresa_id')->index();
            $table->string('centro_costo_id')->index();
            $table->boolean('estado');

            //  Clave Primaria
            $table->primary(['usuario_id', 'empresa_id', 'centro_costo_id']);

            //  Relacion de tablas
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa_usuario');
    }
}
