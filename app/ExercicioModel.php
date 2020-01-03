<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExercicioModel extends Model
{
      protected $fila = [
   	'NOME_EXERCICIO',
   	'DESCRICAO_EXERCICIO',
   ];

   protected $table = 'tb_exercicio';
   protected $primary = 'ID_EXERCICIO';
}
