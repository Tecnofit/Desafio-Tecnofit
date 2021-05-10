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
}