<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Exercicio.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Usuario.php");

$action = $_GET["action"];
session_start();

switch ($action) {
	case "novo":
	try {
		$exercicio = new Exercicio();
		$exercicio->setNome($_POST['nome']);
		$retorno = $exercicio->cadastrar();
		if($retorno < 1){
			throw new Exception("Não foi possível cadastrar este exercício");
		}
		$_SESSION["msg"] = "Exercício cadastrado com sucesso";
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/exercicio_listagem.php");
	} catch(Exception $e){
		$_SESSION["msg"] = $e->getMessage();
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/exercicio_listagem.php");
	}
	break;

	case "excluir":
	try {
		$codigo = $_GET["codigo"];
		$retorno = Exercicio::excluir($codigo);
		if($retorno < 1){
			throw new Exception("Impossível excluir este Exercício, pois há um treino ativo utilizando-o");
		}
		$_SESSION["msg"] = "Exercício excluido com sucesso";
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/exercicio_listagem.php");
	} catch (Exception $e){
		$_SESSION["msg"] = $e->getMessage();
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/exercicio_listagem.php");
	}
	break;

	case "buscar":
	try {
		$codigo = $_GET["codigo"];
		if(empty($codigo)){
			throw new Exception("Não foi possível encontrar este exercicio");
		}
		Exercicio::buscar($codigo);
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/exercicio_edit.php?codigo=$codigo");
	} catch (Exception $e){
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/exercicio_listagem.php");
		$_SESSION["msg"] = $e->getMessage();
	}
	break;
	
	case "edit":
	try {
		$exercicio = new Exercicio();
		$exercicio->setCodigo($_POST['codigo']);
		$exercicio->setNome($_POST['nome']);
		$retorno = $exercicio->editar();
		if($retorno < 1){
			throw new Exception("Não foi possível editar este exercicio");
		}
		$_SESSION["msg"] = "Edição realizada com sucesso";
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/exercicio_listagem.php");
	} catch (Exception $e) {
		$_SESSION["msg"] = $e->getMessage();
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/exercicio_listagem.php");
	}
	break;

	case "atualizaStatus":
	try {
		$codigo = $_GET["codigo"];
		$codUsuario = $_GET["codUsuario"];
		$status = $_POST['status'];
		Exercicio::atualizaStatus($status, $codigo, $codUsuario);
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/treino_usuario.php");
	} catch (Exception $e) {
		$_SESSION["msg"] = $e->getMessage();
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/treino_usuario.php");
	}
	break;

	default:
	$_SESSION["msg"] = "Ação Inválida, contate um administrador do sistema, Ação: $action";
	header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/index.php");
	break;

}