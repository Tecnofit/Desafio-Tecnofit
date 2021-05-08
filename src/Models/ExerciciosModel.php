<?php
namespace Tecnofit\Models;

use Tecnofit\Database\Database;

require_once __DIR__ . "/../../vendor/autoload.php";

class ExerciciosModel extends Database
{
    protected function todosExercicios() : array
    {
        $query = "
            SELECT *
            FROM Exercicios
            WHERE ativo = 1";

        return $this->database->query($query)->fetchAll();
    }

    protected function getExercicioID($id) : array
    {
        $query = "
            SELECT *
            FROM Exercicios
            WHERE id = %s
            ";

        return $this->database->query(sprintf($query , $id))->fetchAll();
    }


    protected function updateTreino(int $id, string $nome) : void
    {
        $query = "
            UPDATE Exercicios
            SET nome='%s'
            WHERE id = %s; 
        ";

        $this->database->query(sprintf($query, $nome, $id));
    }

}