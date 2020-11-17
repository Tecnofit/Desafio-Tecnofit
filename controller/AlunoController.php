<?php

require "../model/Alunos.php";

class AlunoController
{

    private static $instance;
    private $conn;

    public function __construct()
    {
        $this->conn = Connection::getInstance()->getConnection();
    }

    //Singleton Pattern
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function cadastrar($nome)
    {
        $found = $this->pesquisar($nome);
        if ($found == NULL) {
            $result = $this->conn->query(
                "INSERT INTO aluno VALUES (DEFAULT, '$nome')");
            echo Connection::getInstance()->errorConnections();
            return $result;
        }
        return false;
    }


    public function pesquisar($nome)
    {
        $result = $this->conn->query("SELECT * FROM aluno WHERE nome = '$nome'");
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return NULL;
    }

    public function remover($nome)
    {
        $result = $this->conn->query(
            "DELETE FROM aluno WHERE nome = '$nome'");
        echo Connection::getInstance()->errorConnections();
        return $result;
    }

    public function atualizar($cod, $nome)
    {
        $result = $this->conn->query(
            "UPDATE aluno SET nome = '$nome'
                        WHERE cod = $cod");
        echo Connection::getInstance()->errorConnections();
        if ($result) {
            return $result;
        }
        return NULL;
    }


}