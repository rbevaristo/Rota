<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('employee_id')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('position_id')->unsigned();
            $table->integer('role_id')->unsigned()->default(3);
            $table->integer('user_id')->unsigned();
            
            $table->foreign('position_id')->references('id')->on('positions');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('user_id')->references('id')->on('users');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
