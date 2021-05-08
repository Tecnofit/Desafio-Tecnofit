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


    protected function exercicioAtivoTreio(int $id) : array
    {
        $query = "
            SELECT Exercicios.id as exercicio_id
            FROM Exercicios
            JOIN Treino_Exercicios ON Exercicios.id = Treino_Exercicios.id_treino
            WHERE Exercicios.id = %s;
        ";

        return $this->database->query(sprintf($query, $id))->fetchAll();
    }


    protected function adicionarExercicio(array $exercicio) : void
    {
        $query = "
             INSERT INTO Exercicios (nome)
             VALUES ('%s'); 
        ";

        $this->database->query(sprintf($query , $exercicio['nome']));
    }


    protected function updateExercicio(int $id, string $nome) : void
    {
        $query = "
            UPDATE Exercicios
            SET nome='%s'
            WHERE id = %s; 
        ";

        $this->database->query(sprintf($query, $nome, $id));
    }


    protected function deleteExercicio(int $id) : void
    {
        $query = "
            UPDATE Exercicios
            SET ativo = 0
            WHERE id = %s
        ";

        $this->database->query(sprintf($query , $id));
    }

}