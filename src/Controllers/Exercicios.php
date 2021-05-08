<?php
namespace Tecnofit\Controllers;

class Exercicios
{
    public function proximoExercicio($exercicioID)
    {
        $url_retorno = $_SERVER['REQUEST_URI'];

        if (strpos($url_retorno, "id_exercicio")) {
            $url_retorno = explode("&", $url_retorno);
            return $url_retorno[0] . sprintf("&id_exercicio=%s", $exercicioID + 1);
        }
        return $url_retorno . sprintf("&id_exercicio=%s", $exercicioID + 1);
    }
}