<?php
namespace Tecnofit\Models;

use Tecnofit\Database\Database;

class TreinoModel extends Database
{

    public function getAllTreinos() : array
    {
        $query = "
            SELECT * FROM Treino
            WHERE ativo = 1;
        ";

        return $this->database->query($query)->fetchAll();
    }

    public function getTreinoByAlunoID(int $id) : array
    {
        $query = "
          SELECT Exercicios.nome as exercicio, 
                 Treino.nome as treino, 
                 Treino_Exercicios.repeticoes as repeticoes
            FROM Exercicios
            JOIN Treino_Exercicios ON Treino_Exercicios.id_exercicios = Exercicios.id
            JOIN Treino ON Treino.id = Treino_Exercicios.id_treino
            JOIN Aluno ON Treino.id = Aluno.treino_id
            WHERE Aluno.treino_id = %s";

        return $this->database->query(sprintf($query, $id))->fetchAll();
    }


    public function finalizarTreinoUsuario(int $id) : void
    {
        $query = "
            UPDATE Aluno
            SET Aluno.treino_id = 0
            WHERE Aluno.id = %s;
        ";

        $this->database->query(sprintf($query,$id));
    }


}