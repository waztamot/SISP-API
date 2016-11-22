<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('identification')->unique();
            $table->string('image')->default('false');
            $table->string('name');
            $table->string('password');
            $table->integer('payroll_type')->using();
            $table->boolean('active')->default(1);
            $table->string('api_token', 60)->unique();
            $table->rememberToken();
            
            $table->string('company_id');
            $table->string('cost_center_id');
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
