<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ['name'];
    
    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'workout_exercises', 'id_exercise', 'id_workout');
    }
}
