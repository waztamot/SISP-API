<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-11-14 11:36:35
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-30 10:58:07
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class of type Migration by table Combo lapse 
 * @author Francisco Mendoza. 
 */
class CreateComboLapsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combo_lapses', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->date('date_start');
            $table->date('date_end');

            $table->string('combo_id');

            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('combo_lapses');
    }
}
