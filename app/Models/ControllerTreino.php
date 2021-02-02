<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ControllerAluno;
use App\Models\ControllerExercicio;

class ControllerTreino extends Model
{
    protected $table = 'treino';
    protected $fillable = ['id', 
                           'id_aluno',
                           'id_exercicio',
                           'nome'
                          ];

    public function rules()
    {
        return [
            'id_aluno' => 'required',
            'id_exercicio' => 'required',
            'nome' => 'required'
        ];
    }

    public function aluno()
    {
        return $this->hasMany(ControllerAluno::class, 'id_aluno', 'id');
    }

    public function exercicio()
    {
        return $this->hasMany(ControllerVenda::class, 'id_exercicio', 'id');
    }

}
