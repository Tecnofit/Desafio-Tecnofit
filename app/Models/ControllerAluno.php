<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ControllerTreino;

class ControllerAluno extends Model
{
    protected $table = 'aluno';
    protected $fillable = ['id', 
                           'nome',
                           'email'
                          ];

    public function rules()
    {
        return [
            'nome' => 'required',
            'email' => 'required'
        ];
    }

    public function treino() {
        return $this->belongsTo(ControllerTreino::class, 'id_aluno', 'id');
    }

}
