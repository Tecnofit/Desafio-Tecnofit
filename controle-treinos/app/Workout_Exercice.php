<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workout_Exercice extends Model
{
    protected $fillable = ['id_workout', 'id_exercice', 'series', 'done'];

    public function workouts() 
    {
        return $this->belongsToMany(Workout::class);
    }
}
