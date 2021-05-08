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
}