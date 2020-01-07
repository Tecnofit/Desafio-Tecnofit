<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Conexao.php");

class Treino {
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

	private static function populaTreino($row){
		$treino = new treino();
		$treino->setCodigo($row["id"]);
		$treino->setNome($row["nome"]);
		return $treino;
	}

	public function buscar($codigo){
		$conn = new Conexao();
		$sql = "SELECT * FROM treino WHERE id = '$codigo' ORDER BY nome";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		$row = $result->fetch_assoc();
		$treino = Treino::populatreino($row);
		return $treino;
	}

	public static function listar(){
		$conn = new Conexao();
		$sql = "SELECT * FROM treino ORDER BY nome";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		$treinos = [];
		while ($row = $result->fetch_assoc()) {
			array_push($treinos, treino::populatreino($row));
		}
		return $treinos;
	}

	public static function buscaTreinoExercicio($codigoTreino){
		$conn = new Conexao();
		$sql = "SELECT * FROM treino_exercicio WHERE id_treino = $codigoTreino ORDER BY id";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		$treinosExercicios = [];
		while ($row = $result->fetch_assoc()) {
			$treinoExercicio = $row["id"] . ":" . $row["sessoes"] . ":" . $row["id_exercicio"];
			array_push($treinosExercicios, $treinoExercicio);
		}
		return $treinosExercicios;
	}

	public static function excluir($codigo){
		$conn = new Conexao();
		$sql = "DELETE FROM treino WHERE id = '$codigo'";
		$msg = $conn->mysqli->query($sql) ? "Sucesso" : "Falha";
		$conn->mysqli->close();
	}

	public function cadastrar(){
		$conn = new Conexao();
		$sql = "INSERT INTO treino(nome) VALUES ('" . $this->getNome() . "')";
		$result = $conn->mysqli->query($sql);
		$idTreino = $conn->mysqli->insert_id;
		$conn->mysqli->close();
		return $idTreino;
	}

	public function editar(){
		$conn = new Conexao();
		$sql = "UPDATE treino SET nome = '" . $this->getNome() . "' WHERE id = '" . $this->getCodigo() . "'";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		return $result;
	}

	public function cadastroTreinoExercicio($idTreino, $exerciciosSessoes){
		$conn = new Conexao();
		$sql = "DELETE FROM treino_exercicio WHERE id_treino = '" . $idTreino . "'";
		$conn->mysqli->query($sql);
		forEach($exerciciosSessoes as $exercicioSessao){
			$arrExercSess = explode(":", $exercicioSessao);
			$qtdSessao   = $arrExercSess[1];
			$idExercicio = $arrExercSess[2];
			$sql = "INSERT INTO treino_exercicio(id_treino, id_exercicio, sessoes) VALUES ('" . $idTreino . "' , '" . $idExercicio . "', '" . $qtdSessao . "')";
			$conn->mysqli->query($sql);
		}
		$conn->mysqli->close();
	}
}


