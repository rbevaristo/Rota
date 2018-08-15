<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filename');
            $table->integer('emp_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('active')->default(false);
            $table->foreign('emp_id')->references('id')->on('employees');
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
        Schema::dropIfExists('evaluation_files');
    }
}
