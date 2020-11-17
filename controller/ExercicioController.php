<?php

require "../model/Exercicios.php";

class ExercicioController
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

    public function cadastrar($nome, $codTreino, $repeticoes, $estado = 'criado')
    {
        $found = $this->pesquisar($nome);
        if ($found == NULL) {
            $result = $this->conn->query(
                    "INSERT INTO exercicio VALUES (DEFAULT, '$nome', $codTreino, $repeticoes, '$estado')")
                or die($this->conn->error);
            echo Connection::getInstance()->errorConnections();
            return $result;
        }
        return false;
    }


    public function pesquisar($nome)
    {
        $result = $this->conn->query("SELECT * FROM exercicio WHERE nome = '$nome'");
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return false;
    }

    public function pesquisarPorCodigo($cod)
    {
        $result = $this->conn->query("SELECT * FROM exercicio WHERE cod = $cod");
        if ($result->num_rows > 0) {
            return $result->fetch_all();
        }
        return false;
    }

    public function pesquisarPorTreino($codAluno)
    {
        $result = $this->conn->query("SELECT * FROM treinamento WHERE codAluno = $codAluno");
        if ($result->num_rows > 0) {
            return $result->fetch_all();
        }
        return false;
    }

    public function remover($nome)
    {
        $result = $this->conn->query(
            "DELETE FROM exercicio WHERE nome = '$nome'");
        echo Connection::getInstance()->errorConnections();
        return $result;
    }

    public function atualizar($cod, $nome, $codTreino, $repeticoes, $estado)
    {
        $result = $this->conn->query(
            "UPDATE exercicio SET nome = '$nome', codTreino = $codTreino, repeticoes = $repeticoes, estado = '$estado' 
                        WHERE cod = $cod");
        echo Connection::getInstance()->errorConnections();
        return $result;
    }

}