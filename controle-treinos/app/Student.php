<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'age', 'address', 'notes', 'active_workout'];

    public function workouts() 
    {
        return $this->hasMany(Workout::class);
    }
}
