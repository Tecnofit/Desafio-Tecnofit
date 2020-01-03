<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreinoModel extends Model
{
       protected $fila = [
   	'NOME_FICHA',
   	'EXERCICIO_UM',
   	'EXERCICIO_UM_QTD_SESSAO',
   	'EXERCICIO_DOIS',
   	'EXERCICIO_DOIS_QTD_SESSAO',
   	'EXERCICIO_TRES',
   	'EXERCICIO_TRES_QTD_SESSAO',
   	'EXERCICIO_QUATRO',
   	'EXERCICIO_QUATRO_QTD_SESSAO',
   	'ID_ALUNO_FICHA',
   	'STATUS',
   ];

   protected $table = 'tb_ficha_treino';
   protected $primary = 'ID_FICHA';
}

