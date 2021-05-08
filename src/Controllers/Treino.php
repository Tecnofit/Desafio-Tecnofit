<?php

namespace Tecnofit\Controllers;

use Tecnofit\Models\TreinoModel;

class Treino extends TreinoModel
{

    public function index() : array
    {
        return $this->getAllTreinos();
    }

    public function getTreinoAluno(int $id, int $exercicioAtual = 0) : array
    {
        $treinos = $this->getTreinoByAlunoID($id);
        if (!empty($treinos)) {
            $totalExercicios = count($treinos);
            if ($totalExercicios <= $exercicioAtual) {
                return [ "mensagem" => "Treino finalizado com sucesso!",
                         "observacao" => "Aperte o botão em finalizar"];
            }
            return $treinos[$exercicioAtual];
        }
        return [];
    }


    public function finalizarTreino(int $idUsuario) : void
    {
        $this->finalizarTreinoUsuario($idUsuario);
    }


}