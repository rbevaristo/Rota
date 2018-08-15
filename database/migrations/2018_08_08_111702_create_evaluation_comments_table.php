<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('qualities')->nullable();
            $table->text('improvements')->nullable();
            $table->text('comments')->nullable();
            $table->integer('eval_id')->unsigned();
            $table->foreign('eval_id')->references('id')->on('evaluation_results');
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
        Schema::dropIfExists('evaluation_comments');
    }
}
