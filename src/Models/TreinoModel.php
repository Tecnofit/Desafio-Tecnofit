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
            WHERE Aluno.id = %s";

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


    public function getTreinoByID(int $id) : array
    {
        $query = "
            SELECT * FROM Treino
            WHERE ativo = 1
            AND id = %s;
        ";

        return $this->database->query(sprintf($query , $id))->fetchAll();
    }


    public function cadastrarExercicio(int $id_treino , int $id_exercicio  , int $repeticoes) : void
    {
        $query = "
             INSERT INTO Treino_Exercicios (id_treino, id_exercicios, repeticoes)
             VALUES (%s, %s, %s); 
        ";

        $this->database->query(sprintf($query, $id_treino, $id_exercicio, $repeticoes));
    }


     public function getExerciciosTreino(int $id_treino) : array
     {
         $query = "
            SELECT Exercicios.nome as exercicios_nome ,
                   Exercicios.id  as exercicios_id,
                   Treino_Exercicios.repeticoes as exercicios_repeticoes
            FROM Exercicios
            JOIN Treino_Exercicios ON Treino_Exercicios.id_exercicios = Exercicios.id
            JOIN Treino ON Treino_Exercicios.id_treino = Treino.id
            WHERE Exercicios.ativo = 1
            AND Treino.ativo = 1
            AND Treino.id = %s
         ";

         return $this->database->query(sprintf($query, $id_treino))->fetchAll();
     }


     public function removerExercicio(int $id_treino, int $id_exercicio) : void
     {
         $query = "
            DELETE FROM Treino_Exercicios
            WHERE Treino_Exercicios.id_treino = %s
            AND Treino_Exercicios.id_exercicios = %s
         ";

         $this->database->query(sprintf($query, $id_treino, $id_exercicio));
     }


     public function updateTreino(string $nome , int $id_treino) : void
     {
         $query = "
            UPDATE Treino
            SET nome = '%s'
            WHERE id = %s
         ";

         $this->database->query(sprintf($query, $nome, $id_treino));
     }


     public function deletarTreino(int $id_treino) : void
     {
         $query = "
            DELETE FROM Treino_Exercicios
            WHERE Treino_Exercicios.id_treino = %s
         ";
         $this->database->query(sprintf($query, $id_treino));

         $query = "
              UPDATE Treino
              SET ativo = 0
              WHERE id = %s;
         ";
         $this->database->query(sprintf($query, $id_treino));
     }


     public function adicionarTreino(string $nome) : void
     {
         $query = "
            INSERT INTO Treino (nome)
             VALUES ('%s'); 
         ";

         $this->database->query(sprintf($query, $nome));
     }


}