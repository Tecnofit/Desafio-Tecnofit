<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Usuario.php");

$action = $_GET["action"];
session_start();

switch ($action) {
	case "login":
	try {
		$login = trim($_POST['usuario']);
		$senha = trim(md5($_POST['senha']));
		$usuario = new Usuario();
		$usuario = $usuario->autenticar($login, $senha);
		if(empty($usuario->getNome())){
			throw new Exception("Usuário não encontrado!");
		}
		$_SESSION["admin"] = $usuario->getAdmin();
		$_SESSION["nome"]  = $usuario->getNome();
		$_SESSION["codigoUsuario"] = $usuario->getCodigo();
		if($usuario->getAdmin() == 1){
			header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/painel_admin.php");
		} else {
			header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/painel.php");
		}
	} catch (Exception $e) {
		$_SESSION["msg"] = $e->getMessage();
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/index.php");
	}
	break;

	case "novo":
	try {
		$usuario = new Usuario();
		$usuario->setNome($_POST['nome']);
		$usuario->setLogin(trim($_POST['login']));
		$usuario->setSenha($_POST['senha']);
		if(isset($_POST['admin'])){
			$usuario->setAdmin('1');
		}
		$retorno = $usuario->cadastrar();
		if($retorno < 1){
			throw new Exception("Não foi possível cadastrar este usuário");
		}
		$_SESSION["msg"] = "Usuário cadastrado com sucesso";
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/usuario_listagem.php");
	} catch(Exception $e){
		$_SESSION["msg"] = $e->getMessage();
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/usuario_listagem.php");
	}
	break;

	case "edit":
	try {
		$usuario = new Usuario();
		$usuario->setCodigo($_POST['codigo']);
		$usuario->setNome($_POST['nome']);
		$usuario->setLogin(trim($_POST['login']));
		$usuario->setSenha($_POST['senha']);
		if(isset($_POST['admin'])){
			$usuario->setAdmin('1');
		}
		$retorno = $usuario->editar();
		if($retorno < 1){
			throw new Exception("Não foi possível editar este usuário");
		}
		$_SESSION["msg"] = "Edição realizada com sucesso";
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/usuario_listagem.php");
	} catch (Exception $e) {
		$_SESSION["msg"] = $e->getMessage();
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/usuario_listagem.php");
	}
	break;

	case "excluir":
	try {
		$codigo = $_GET["codigo"];
		$retorno = Usuario::excluir($codigo);
		if($retorno < 1){
			throw new Exception("Não foi possível excluir este usuário");
		}
		$_SESSION["msg"] = "Exclusão realizada com sucesso";
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/usuario_listagem.php");
	} catch (Exception $e){
		$_SESSION["msg"] = $e->getMessage();
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/usuario_listagem.php");
	}
	break;

	case "buscar":
	try {
		$codigo = $_GET["codigo"];
		if(empty($codigo)){
			throw new Exception("Não foi possível econtrar este usuário");
		}
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/usuario_edit.php?codigo=$codigo");
	} catch (Exception $e){
		$_SESSION["msg"] = $e->getMessage();
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/usuario_listagem.php");
	}
	break;

	case "ativaTreino":
	try{
		$usuario = new Usuario();
		$usuario->setCodigo($_POST["codigo"]);
		$usuario->setTreino($_POST["treino"]);
		$retorno = $usuario->ativarTreino();
		if($retorno < 1){
			throw new Exception("Não foi possível ativar este treino, pois não há vínculos com exercícios");
		}
		$_SESSION["msg"] = "Treino ativo com sucesso";
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/usuario_listagem.php");
	} catch (Exception $e){
		$_SESSION["msg"] = $e->getMessage();
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/usuario_listagem.php");
	}
	break;

	case "finalizar":
	try {
		$codigo = $_GET["codigo"];
		Usuario::finalizarTreino($codigo);
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/treino_usuario.php");
	} catch (Exception $e){
		$_SESSION["msg"] = $e->getMessage();
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/treino_usuario.php");
	}
	break;

	default:
	$_SESSION["msg"] = "Ação Inválida, contate um administrador do sistema, Ação: $action";
	header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/index.php");
	break;
}