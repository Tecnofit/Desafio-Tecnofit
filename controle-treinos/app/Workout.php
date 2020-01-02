<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = ['name', 'description', 'student_id', 'active', 'done'];

    public function exercices() 
    {
        return $this->belongsToMany(Exercice::class, 'workout_exercices', 'id_workout', 'id_exercice')->withPivot('series', 'done');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
