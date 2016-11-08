<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_user', function (Blueprint $table) {
            $table->string('user_id');
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('permits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permit_role', function (Blueprint $table) {
            $table->integer('permit_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permit_id')->references('id')->on('permits')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permit_id', 'role_id']);
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('permit_user', function (Blueprint $table) {
            $table->string('user_id');
            $table->integer('permit_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('permit_id')->references('id')->on('permits')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'permit_id']);
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('permit_user');
        Schema::dropIfExists('permit_role');
        Schema::dropIfExists('permits');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
}
