<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ControllerTreino;

class ControllerExercicio extends Model
{
    protected $table = 'exercicio';
    protected $fillable = ['id', 
                           'nome',
                           'status'
                          ];

    public function rules()
    {
        return [
            'nome' => 'required'
        ];
    }
    
    public function treino() {
        return $this->belongsTo(ControllerTreino::class, 'id_exercicio', 'id');
    }

}
