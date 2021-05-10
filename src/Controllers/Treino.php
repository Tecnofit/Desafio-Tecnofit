<?php
namespace Tecnofit\Controllers;

use Tecnofit\Models\TreinoModel;

class Treino extends TreinoModel
{

    public function index() : array
    {
        return $this->getAllTreinos();
    }

    public function add(string $nome) : void
    {
        $this->adicionarTreino($nome);
    }

    public function edit(int $id) : array
    {
        return $this->getTreinoByID($id);
    }


    public function update(string $nome, $aluno_id) : void
    {
        $this->updateTreino($nome , $aluno_id);
    }


    public function delete(int $id_treino) : void
    {
        $this->deletarTreino($id_treino);
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


    public function getExerciciosByTreinoID(int $id) : array
    {
        return $this->getExerciciosTreino($id);
    }


    public function finalizarTreino(int $idUsuario) : void
    {
        $this->finalizarTreinoUsuario($idUsuario);
    }


    public function addExercicio(array $exercicio, int $idTreino) : void
    {
        $this->cadastrarExercicio($idTreino, $exercicio['id_exercicio'], $exercicio['repeticoes']);
    }


    public function deletarExercicio(int $id_treino, int $id_exercicio) : void
    {
        $this->removerExercicio($id_treino, $id_exercicio);
    }



}