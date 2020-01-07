<?php 

require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Conexao.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Treino.php");

class Usuario {
	private $codigo;
	private $nome;
	private $login;
	private $senha;
	private $treino = 0; 
	private $admin  = 0;

	public function __construct(){

	}

	function getCodigo(){
		return $this->codigo;
	}
	function getNome(){ 
		return $this->nome; 
	}
	function getLogin(){ 
		return $this->login; 
	}
	function getSenha(){ 
		return $this->senha; 
	}
	function getTreino(){
		return $this->treino;
	}
	function getAdmin(){
		return $this->admin;
	}

	function setCodigo($codigo){
		$this->codigo = $codigo;
	}	
	function setNome($nome){ 
		$this->nome = $nome; 
	}
	function setLogin($login){ 
		$this->login = $login;
	}
	function setSenha($senha){ 
		$this->senha = md5($senha); 
	}
	function setTreino($treino){
		$this->treino = $treino;
	}
	function setAdmin($admin){
		$this->admin = $admin;
	}

	private static function populaUsuarios($row){
		$usuario = new Usuario();
		$usuario->setCodigo($row["id"]);
		$usuario->setNome($row["nome"]);
		$usuario->setLogin($row["login"]);
		$usuario->setSenha($row["senha"]);
		$usuario->setTreino($row["usuario_treino"]);
		$usuario->setAdmin($row["admin"]);
		return $usuario;
	}

	public function buscar($codigo){
		$conn = new Conexao();
		$sql = "SELECT * FROM usuario WHERE id = '$codigo'";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		$row = $result->fetch_assoc();
		$usuario = Usuario::populaUsuarios($row);
		return $usuario;
	}

	public static function listar(){
		$conn = new Conexao();
		$sql = "SELECT * FROM usuario WHERE admin IS FALSE ORDER BY nome";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		$usuarios = [];
		while ($row = $result->fetch_assoc()) {
			array_push($usuarios, Usuario::populaUsuarios($row));
		}
		return $usuarios;
	}

	public static function excluir($codigo){
		$conn = new Conexao();
		$sql = "DELETE FROM usuario WHERE id = '$codigo'";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		return $result;
	}

	public function autenticar($login, $senha){
		$conn = new Conexao();
		$sql = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		$row = $result->fetch_assoc();
		$usuario = Usuario::populaUsuarios($row);
		return $usuario;
	}

	public function cadastrar(){
		$conn = new Conexao();
		$sql = "INSERT INTO usuario(nome, login, senha, admin) VALUES ('" . $this->getNome() . "', '" . $this->getLogin() . "', '" . $this->getSenha() . "', '" . $this->getAdmin() . "')";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		return $result;
	}

	public function editar(){
		$conn = new Conexao();
		$sql = "UPDATE usuario SET nome = '" . $this->getNome() . "', login = '" . $this->getLogin() . "', senha = '" . $this->getSenha() . "', admin = '" . $this->getAdmin() . "' WHERE id = '" . $this->getCodigo() . "'";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		return $result;
	}

	public function ativarTreino(){
		$result = 0;
		$conn = new Conexao();
		$exercicios = Treino::buscaTreinoExercicio($this->getTreino());
		if(!empty($exercicios)){
			$sql = "UPDATE usuario SET usuario_treino = '" . $this->getTreino() ."' WHERE id = '" . $this->getCodigo() . "'";
			$result = $conn->mysqli->query($sql);

			$sql = "DELETE FROM treino_usuario WHERE usuario_id = '" . $this->getCodigo() ."'";
			$result = $conn->mysqli->query($sql);

			$status = 0;
			forEach($exercicios as $exercicio){
				$sessaoExercicio = explode(":", $exercicio);
				$idTreinoExercicio = $sessaoExercicio[0];
				$status = empty($status) ? 2 : 1;
				$sql = "INSERT INTO treino_usuario(usuario_id, status, id_treino_exercicio) VALUES ('" . $this->getCodigo() . "' , '" . $status . "', '" . $idTreinoExercicio . "')";
				$result = $conn->mysqli->query($sql);
			}

		}
		$conn->mysqli->close();
		return $result;
	}

	public static function finalizarTreino($codigo){
		$conn = new Conexao();
		$sql = "UPDATE usuario SET usuario_treino = '0' WHERE id = '$codigo'";
		$result = $conn->mysqli->query($sql);
		$sql = "DELETE FROM treino_usuario WHERE id = '$codigo'";
		$result = $conn->mysqli->query($sql);
		$conn->mysqli->close();
		return $result;
	}
}


