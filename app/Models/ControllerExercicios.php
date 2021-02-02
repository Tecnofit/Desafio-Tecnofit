<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ControllerTreino;

class ControllerExercicios extends Model
{
    protected $table = 'exercicios';
    protected $fillable = ['id', 
                           'nome',
                           'descricao'
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
