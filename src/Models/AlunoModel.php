<?php
namespace Tecnofit\Models;

use Tecnofit\Database\Database;

require_once __DIR__ . "/../../vendor/autoload.php";

class AlunoModel extends Database
{

    protected function getAllUsers() : array
    {
        $query = "
        SELECT Aluno.nome AS aluno, Treino.nome AS treino, Aluno.id as aluno_id 
        FROM Aluno
        JOIN Treino ON Aluno.treino_id = Treino.id
        WHERE Aluno.ativo = 1";

        return $this->database->query($query)->fetchAll();
    }


    protected function getAlunoById(int $id) : array
    {
        $query = "
        SELECT Aluno.nome AS aluno_nome, 
               Aluno.email AS aluno_email,  
               Aluno.treino_id AS treino_id, 
               Aluno.id AS aluno_id,
               Treino.nome AS treino
        FROM Aluno
        JOIN Treino ON Aluno.treino_id = Treino.id
        WHERE Aluno.ativo = 1
        AND Aluno.id = %s
        ";

        return $this->database->query(sprintf($query, $id))->fetchAll();
    }


    protected function updateAluno(array $aluno, int $id) : void
    {
        $query = "
           UPDATE Aluno
           SET nome='%s', email='%s', treino_id=%s
           WHERE id = %s;
        ";

        $this->database->query(sprintf($query, $aluno['nome'], $aluno['email'], $aluno['treino'], $id));
    }

}