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

    public function cadastrar($codExercicio = NULL, $nome, $codTreino, $repeticoes, $estado = 'criado')
    {
        $found = $this->pesquisar($nome);
        if ($found == NULL) {
            if ($codExercicio == NULL) {
                $result = $this->conn->query(
                    "INSERT INTO exercicio VALUES (DEFAULT, '$nome', $codTreino, $repeticoes, '$estado')")
                or die($this->conn->error);
            } else {
                //evita alterar o codigo original do exercicio
                $result = $this->conn->query(
                    "INSERT INTO exercicio VALUES ($codExercicio, '$nome', $codTreino, $repeticoes, '$estado')")
                or die($this->conn->error);
            }
            if ($result) {
                return $this->conn->insert_id;
            }
        }
        return $found;
    }


    public function pesquisar($nome)
    {
        $result = $this->conn->query("SELECT * FROM exercicio WHERE nome = '$nome'");
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return NULL;
    }

    public function pesquisarPorCodigo($cod)
    {
        $result = $this->conn->query("SELECT * FROM exercicio WHERE cod = $cod");
        if ($result->num_rows > 0) {
            return $result->fetch_all();
        }
        return NULL;
    }

    public function pesquisarPorTreino($codAluno)
    {
        $result = $this->conn->query("SELECT * FROM treinamento WHERE codAluno = $codAluno");
        if ($result->num_rows > 0) {
            return $result->fetch_all();
        }
        return NULL;
    }

    public function remover($nome)
    {
        $result = $this->conn->query(
            "DELETE FROM exercicio WHERE nome = '$nome'");
        return $result;
    }

    public function atualizar($nome, $codTreino, $repeticoes, $estado)
    {
        $result = $this->conn->query(
            "UPDATE exercicio SET nome = '$nome', codTreino = $codTreino, repeticoes = $repeticoes, estado = $estado 
                        WHERE nome = '$nome'");
        if ($result) {
            return $result;
        }
        return NULL;
    }

}