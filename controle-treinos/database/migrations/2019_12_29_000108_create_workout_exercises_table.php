<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workout_exercises', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_workout');
            $table->foreign('id_workout')
                ->references('id')
                ->on('workouts');
            $table->integer('id_exercise');
            $table->foreign('id_exercise')
                ->references('id')
                ->on('exercises');
            $table->integer('series');
            $table->integer('done')->default(0);
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
        Schema::dropIfExists('workout_exercises');
    }
}
