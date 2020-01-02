<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{
    protected $fillable = ['name'];
    
    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'workout_exercices', 'id_exercice', 'id_workout')->withPivot('series');
    }
}
