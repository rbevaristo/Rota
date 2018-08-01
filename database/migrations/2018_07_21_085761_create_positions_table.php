<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        $position = new App\Position;
        $position->name = "Manager";
        $position->save();
        $position = new App\Position;
        $position->name = "Supervisor";
        $position->save();
        $position = new App\Position;
        $position->name = "Lead Clerk";
        $position->save();
        $position = new App\Position;
        $position->name = "Clerk";
        $position->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');
    }
}
