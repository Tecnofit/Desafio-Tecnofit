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

    public function cadastrar($nome, $cod=NULL)
    {
        $found = $this->pesquisar($nome);
        $result = false;
        if ($found == NULL) {
            if($cod == NULL){
                $result = $this->conn->query(
                    "INSERT INTO treino VALUES (DEFAULT, '$nome')");
            }else{
                $result = $this->conn->query(
                    "INSERT INTO treino VALUES ($cod, '$nome')");
            }
        }else{
            if($cod == NULL){
                //Achou um aluno mas quer atualizar outro existente
                $result = $this->atualizar($found['cod'], $nome);
            }else{
                //Achou o aluno nao passou o código atualize o primeiro encontrado
                $result = $this->atualizar($cod, $nome);
            }
        }
        echo Connection::getInstance()->errorConnections();
        return $result;
    }

    public function pesquisar($nome)
    {
        $result = $this->conn->query("SELECT * FROM treino WHERE nome LIKE '$nome'");
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return false;
    }

    public function remover($nome)
    {
        $result = $this->conn->query(
            "DELETE FROM treino WHERE nome = '$nome'");
        echo Connection::getInstance()->errorConnections();
        return $result;
    }

    public function atualizar($cod, $nome)
    {
        $result = $this->conn->query(
            "UPDATE treino SET nome = '$nome' WHERE cod = $cod");
        echo Connection::getInstance()->errorConnections();
        return $result;
    }

    ///---------------- TREINAMENTO-----------------------------
    public function atualizarTreinamento($codAluno, $codExercicio, $estado = 'disponivel')
    {
        $result = $this->conn->query("SELECT * FROM treinamento WHERE cod = $codExercicio AND codAluno = $codAluno");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $codTreinamento = $row['cod'];
            $result = $this->conn->query(
                "UPDATE treinamento SET estado = '$estado' WHERE cod = $codTreinamento");
        } else {
            $result = $this->conn->query(
                "INSERT INTO treinamento VALUES(DEFAULT, $codAluno, $codExercicio, '$estado')");
        }
        echo Connection::getInstance()->errorConnections();
        return $result;
    }

    public function pesquisarTreinamento($codAluno)
    {
        $result = $this->conn->query("SELECT * FROM treinamento WHERE codAluno = $codAluno");
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return false;
    }

    public function removerTreinamento($cod)
    {
        $result = $this->conn->query(
            "DELETE FROM treinamento WHERE cod = $cod");
        echo Connection::getInstance()->errorConnections();
        return $result;
    }
}