<?php
namespace Tecnofit\Controllers;

use Tecnofit\Models\ExerciciosModel;

class Exercicios extends ExerciciosModel
{

    public function proximoExercicio(int $exercicioID) : string
    {
        $url_retorno = $_SERVER['REQUEST_URI'];

        if (strpos($url_retorno, "id_exercicio")) {
            $url_retorno = explode("&", $url_retorno);
            return $url_retorno[0] . sprintf("&id_exercicio=%s", $exercicioID + 1);
        }
        return $url_retorno . sprintf("&id_exercicio=%s", $exercicioID + 1);
    }

    public function index() : array
    {
        return $this->todosExercicios();
    }


    public function edit(int $id) : array
    {
        return $this->getExercicioID($id);
    }


    public function update(array $nome, $id) : void
    {
         $this->updateTreino($id, $nome['nome']);
    }
}