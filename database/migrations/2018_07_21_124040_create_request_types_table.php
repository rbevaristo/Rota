<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            // $table->integer('user_id')->unsigned()->nullable();
            // $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        $request = new App\RequestType;
        $request->name = "Vacation Leave";
        $request->save();
        $request = new App\RequestType;
        $request->name = "Sick Leave";
        $request->save();
        $request = new App\RequestType;
        $request->name = "Emergency Leave";
        $request->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_types');
    }
}
