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
}