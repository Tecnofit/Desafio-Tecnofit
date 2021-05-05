<?php
namespace Tecnofit\Database;

use PDO;

require_once __DIR__ . "/../../vendor/autoload.php";

class Database
{
    protected $database;

    public function __construct()
    {
        $user = "professor";
        $pass = "tecnofit";

        try {
           $this->database = new PDO('mysql:host=tecnofit-mysql;dbname=academia_tecnofit', $user, $pass,
               [
                   PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                   PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                   PDO::ATTR_EMULATE_PREPARES   => FALSE,
               ]
           );
        } catch (\PDOException $e) {
            print_r("Error to connection database : ". $e->getMessage());
        }
    }


    protected function findWhere()
    {
        $query = "
            SELECT Exercicios.nome as exercicio, Treino.nome as treino, Treino_Exercicios.repeticoes as repeticoes
            FROM Exercicios
            JOIN Treino_Exercicios ON Treino_Exercicios.id_exercicios = Exercicios.id
            JOIN Treino ON Treino.id = Treino_Exercicios.id_treino
            JOIN Aluno ON Treino.id = Aluno.treino_id
            WHERE Aluno.treino_id = 1";
        $data = $this->database->query($query);
        return $data->fetchAll();
    }
}