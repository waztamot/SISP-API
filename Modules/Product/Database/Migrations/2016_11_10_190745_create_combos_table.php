<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-10 15:07:45
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-21 15:21:20
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class of type Migration by table Combos
 * @author Javier Alarcon
 */
class CreateCombosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combos', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('company');
            $table->string('name');
            $table->integer('max_quantity')->unsigned()->default(0);
            $table->string('concept_paysheet')->nullable();
            $table->boolean('automatic_loading')->default(false);
            $table->string('type');

            $table->string('parent_id')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('combos')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combos');
    }
}
