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
                "INSERT INTO aluno VALUES (DEFAULT, '$nome')")
            or die($this->conn->error);
            if ($result) {
                return $this->conn->insert_id;
            }
        }
        return $found;
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
        return $result;
    }

    public function atualizar($nome)
    {
        $result = $this->conn->query(
            "UPDATE aluno SET nome = '$nome'
                        WHERE nome = '$nome'");
        if ($result) {
            return $result;
        }
        return NULL;
    }


}