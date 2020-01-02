<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutExercicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workout_exercices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_workout')->onDelete('cascade');
            $table->integer('id_exercice')->onDelete('cascade');
            $table->integer('done')->default(0);
            $table->integer('series');
            $table->timestamps();

            $table->foreign('id_workout')->references('id')->on('workouts');
            $table->foreign('id_exercice')->references('id')->on('exercices');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workout_exercices');
    }
}
