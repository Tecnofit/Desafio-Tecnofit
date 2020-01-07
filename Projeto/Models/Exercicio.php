<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Conexao.php");

class Exercicio {
	private $codigo;
	private $nome;

	public function __construct(){

	}

	function getCodigo(){
		return $this->codigo;
	}
	function getNome(){ 
		return $this->nome; 
	}

	function setCodigo($codigo){
		$this->codigo = $codigo;
	}	
	function setNome($nome){ 
		$this->nome = $nome; 
	}

	private static function populaExercicio($row){
		$exercicio = new exercicio();
		$exercicio->setCodigo($row["id"]);
		$exercicio->setNome($row["nome"]);
		return $exercicio;
	}

	public function buscar($codigo){
		$conn = new Conexao();
		$sql = "SELECT * FROM exercicio WHERE id = '$codigo'";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		$row = $result->fetch_assoc();
		$exercicio = Exercicio::populaexercicio($row);
		return $exercicio;
	}

	public static function listar(){
		$conn = new Conexao();
		$sql = "SELECT * FROM exercicio ORDER BY nome";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		$exercicios = [];
		while ($row = $result->fetch_assoc()) {
			array_push($exercicios, exercicio::populaexercicio($row));
		}
		return $exercicios;
	}

	public static function excluir($codigo){
		$conn = new Conexao();
		$sql = "DELETE FROM exercicio WHERE id = '$codigo' AND (SELECT t.id_exercicio FROM treino_exercicio t 
		INNER JOIN usuario u ON t.id_treino = u.usuario_treino 
		WHERE t.id_exercicio = '$codigo') IS NULL";
		$conn->mysqli->query($sql);
		$result = $conn->mysqli->affected_rows;
		$conn->mysqli->close();
		return $result;
	}

	public function cadastrar(){
		$conn = new Conexao();
		$sql = "INSERT INTO exercicio(nome) VALUES ('" . $this->getNome() . "')";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		return $result;
	}

	public function editar(){
		$conn = new Conexao();
		$sql = "UPDATE exercicio SET nome = '" . $this->getNome() . "' WHERE id = '" . $this->getCodigo() . "'";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		return $result;
	}

	public static function buscaStatus($codigo){
		$conn = new Conexao();
		$sql = "SELECT status FROM treino_usuario WHERE id_treino_exercicio = '$codigo'";
		$result = $conn->mysqli->query($sql);
		$row = $result->fetch_assoc();
		$conn->mysqli->close();
		return $row['status'];
	}

	public static function atualizaStatus($status, $codigo, $codigoUsuario){
		$conn = new Conexao();
		$sql = "UPDATE treino_usuario SET status = '$status' WHERE id_treino_exercicio = '$codigo'";
		$result = $conn->mysqli->query($sql);
		$sql = "UPDATE treino_usuario AS tu1 JOIN (SELECT MIN(id_treino_exercicio) AS id FROM treino_usuario WHERE status = 1) AS id
		ON (tu1.id_treino_exercicio = id.id) SET status = 2";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		return $result;
	}
}


