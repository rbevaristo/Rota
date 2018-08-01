<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('factor');
            $table->text('description');
            $table->timestamps();
        });

        $eval = new \App\Evaluation;
        $eval->factor = 'Quality of Work';
        $eval->description = 'Work performed according to standards and requirements.';
        $eval->save();
        $eval = new \App\Evaluation;
        $eval->factor = 'Efficiency of Work';
        $eval->description = 'Amount completed in relation to standards';
        $eval->save();
        $eval = new \App\Evaluation;
        $eval->factor = 'Dependability';
        $eval->description = 'Follow-through, complete work, on time, punctual.';
        $eval->save();
        $eval = new \App\Evaluation;
        $eval->factor = 'Job Knowledge';
        $eval->description = 'Understanding of job functions and responsibilities.';
        $eval->save();
        $eval = new \App\Evaluation;
        $eval->factor = 'Attitude';
        $eval->description = 'Cooperative, flexible, ability to work well with others.';
        $eval->save();
        $eval = new \App\Evaluation;
        $eval->factor = 'Housekeeping';
        $eval->description = 'Cleanliness, organize and order at work area.';
        $eval->save();
        $eval = new \App\Evaluation;
        $eval->factor = 'Reliability';
        $eval->description = 'Record of attendance and tardiness for work.';
        $eval->save();
        $eval = new \App\Evaluation;
        $eval->factor = 'Personal Care';
        $eval->description = 'Grooming, dress, health, personal cleanliness.';
        $eval->save();
        $eval = new \App\Evaluation;
        $eval->factor = 'Judgement';
        $eval->description = 'Ability to respond to varying situations and make sound decisions.';
        $eval->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
