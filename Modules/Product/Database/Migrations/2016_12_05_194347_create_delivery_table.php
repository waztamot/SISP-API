<?php
/**
 * @Author: Javier Alarcon
 * @Date:   2016-12-05 15:43:47
 * @Last Modified by:   Javier Alarcon
 * @Last Modified time: 2016-12-29 09:30:55
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class of type Migration by table Products
 * @author Javier Alarcon
 */
class CreateDeliveryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('identification');

            $table->string('requisition_id');
            $table->string('user_id');

            $table->timestamps();
            $table->softDeletes();

            $table->primary(['id', 'requisition_id']);

            $table->foreign('requisition_id')->references('id')->on('requisitions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('delivery');
    }
}
