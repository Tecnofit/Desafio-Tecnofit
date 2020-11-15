<?php

require "../model/Treinos.php";

class TreinoController
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

    public function cadastrar($cod, $nome)
    {
        $found = $this->pesquisar($nome);
        if ($found == NULL) {
            $result = $this->conn->query(
                "INSERT INTO treino VALUES ($cod, '$nome')")
            or die($this->conn->error);
            if ($result) {
                echo $this->conn->affected_rows;
                return $this->conn->insert_id;
            }
        }
        return $found;
    }

    public function pesquisar($nome)
    {
        $result = $this->conn->query("SELECT * FROM treino WHERE nome LIKE '$nome'");
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return NULL;
    }

    public function remover($nome)
    {
        $result = $this->conn->query(
            "DELETE FROM treino WHERE nome = '$nome'");
        return $result;
    }

    public function atualizar($nome, $cod, $codTreino)
    {
        $result = $this->conn->query(
            "UPDATE treino SET nome = '$nome' WHERE nome = '$nome'");
        if ($result) {
            return $result;
        }
        return NULL;
    }

    ///---------------- TREINAMENTO-----------------------------
    public function atualizarTreinamento($codAluno, $codExercicio, $estado = 'disponivel')
    {
        $result = $this->conn->query("SELECT * FROM treinamento WHERE cod = $codExercicio AND codAluno = $codAluno");
        if ($result) {
            $row = $result->fetch_assoc();
            $codTreinamento = $row['cod'];
            $result = $this->conn->query(
                "UPDATE treinamento SET estado = '$estado' WHERE cod = $codTreinamento");
            if ($result) {
                return $result;
            }
        } else {
            $result = $this->conn->query(
                "INSERT INTO treinamento VALUES(DEFAULT, $codAluno, $codExercicio, $estado");
            if ($result) {
                return $result;
            }
        }
        return NULL;
    }

    public function pesquisarTreinamento($codAluno)
    {
        $result = $this->conn->query("SELECT * FROM treinamento WHERE codAluno = $codAluno");
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return NULL;
    }

}