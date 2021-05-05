<?php
namespace Tecnofit\Models;

use Tecnofit\Database\Database;

require_once __DIR__ . "/../../vendor/autoload.php";

class AlunoModel extends Database
{
    protected function getAllUsers()
    {
        $query = "
        SELECT Aluno.nome AS aluno, Treino.nome AS treino, Aluno.id as aluno_id 
        FROM Aluno
        JOIN Treino ON Aluno.treino_id = Treino.id
        WHERE Aluno.ativo = 1";

        return $this->database->query($query)->fetchAll();
    }
}