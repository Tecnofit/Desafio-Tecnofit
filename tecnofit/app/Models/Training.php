<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'exercise_id', 'sessions', 'status', 'active'
    ];

    public function exercises(){
        return $this->belongsTo('App\Models\Exercise', 'exercise_id');
    }
}
