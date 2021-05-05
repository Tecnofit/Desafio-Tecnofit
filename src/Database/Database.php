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
           $this->database = new PDO('mysql:host=tecnofit-mysql;dbname=academia_tecnofit', $user, $pass, [PDO::FETCH_ASSOC]);
        } catch (\PDOException $e) {
            print_r("Error to connection database : ". $e->getMessage());
        }
    }


    public function findWhere()
    {
        $query = "SELECT * FROM Aluno";
        $data = $this->database->query($query);
        return $data->fetchAll();
    }
}