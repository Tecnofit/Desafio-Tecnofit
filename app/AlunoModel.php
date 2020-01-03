<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlunoModel extends Model
{
   protected $fila = [
   	'NOME',
   	'CPF',
   	'DATA_NASCIMENTO',
   	'SEXO',
   	'OBS',
   ];

   protected $table = 'tb_aluno';
   protected $primary = 'ID';
}
