<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    protected $fillable = ['name', 'description', 'student_id', 'active', 'done'];

    public function exercises() 
    {
        return $this->belongsToMany(Exercise::class, 'workout_exercises', 'id_workout', 'id_exercise')->withPivot('series', 'done');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

}
