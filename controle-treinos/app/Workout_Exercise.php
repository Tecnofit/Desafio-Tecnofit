<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workout_Exercise extends Model
{
    protected $fillable = ['id_workout', 'id_exercise', 'series', 'done'];

    public function workouts() 
    {
        return $this->belongsToMany(Workout::class);
    }
}
