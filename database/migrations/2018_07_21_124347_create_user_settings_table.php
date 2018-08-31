<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('num_days')->default(7);
            $table->integer('')->default(1);
            $table->string('sched_dayoff')->default(0000000);
            $table->boolean('sharing')->default(false);
            $table->boolean('dayoff')->default(false);
            $table->boolean('shift')->default(false);
            $table->boolean('shuffle')->default(false);            
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_settings');
    }
}
