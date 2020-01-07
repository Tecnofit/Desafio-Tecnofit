<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Treino.php");

$action = $_GET["action"];
session_start();

switch ($action) {
	case "novo":
	try {
		$treino = new Treino();
		$treino->setNome($_POST['nome']);
		$sessoesExercicios = [];
		for($i = 1; $i < 5; $i++){
			if(isset($_POST["exercicio$i"]) && !empty($_POST["exercicio$i"])){
				$sessaoExercicio = ':';
				$sessaoExercicio .= isset($_POST["sessao$i"]) && !empty($_POST["sessao$i"]) ? strval($_POST["sessao$i"]) : '12';
				$sessaoExercicio .=  ':' . $_POST["exercicio$i"];
				array_push($sessoesExercicios, $sessaoExercicio);
			}
		}
		$retorno = $treino->cadastrar();
		if($retorno < 1){
			throw new Exception('Não foi possivel cadastrar este Treino');
		}
		$treino->cadastroTreinoExercicio($idTreino, $sessoesExercicios);
		$_SESSION["msg"] = "Treino cadastrado com sucesso";
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/treino_listagem.php");
	} catch(Exception $e){
		$_SESSION["msg"] = $e->getMessage();
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/treino_listagem.php");
	}
	break;
	
	case "edit":
	try {
		$treino = new Treino();
		$treino->setCodigo($_POST['codigo']);
		$treino->setNome($_POST['nome']);
		$sessoesExercicios = [];
		for($i = 1; $i < 5; $i++){
			if(isset($_POST["exercicio$i"]) && !empty($_POST["exercicio$i"])){
				$sessaoExercicio = ':';
				$sessaoExercicio .= isset($_POST["sessao$i"]) && !empty($_POST["sessao$i"]) ? strval($_POST["sessao$i"]) : '12';
				$sessaoExercicio .=  ':' . $_POST["exercicio$i"];
				array_push($sessoesExercicios, $sessaoExercicio);
			}
		}
		$retorno = $treino->editar();
		if($retorno < 1){
			$retorno = $treino->cadastroTreinoExercicio($treino->getCodigo(), $sessoesExercicios);
		}	
		if($retorno < 1){
			throw new Exception('Não foi possivel editar este Treino');
		}
		$_SESSION["msg"] = "Edição realizada com sucesso";
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/treino_listagem.php");
	} catch (Exception $e) {
		$_SESSION["msg"] = $e->getMessage();
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/treino_listagem.php");
	}
	break;

	case "excluir":
	try {
		$codigo = $_GET["codigo"];
		$retorno = Treino::excluir($codigo);
		if($retorno < 1){
			throw new Exception('Não foi possivel excluir este registro');
		}	
		$_SESSION["msg"] = "Exclusão realizada com sucesso";
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/treino_listagem.php");
	} catch (Exception $e){
		$_SESSION["msg"] = $e->getMessage();
	}
	break;

	case "buscar":
	try {
		$codigo = $_GET["codigo"];
		Treino::buscar($codigo);
		header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/Views/treino_edit.php?codigo=$codigo");
	} catch (Exception $e){
		$_SESSION["msg"] = $e->getMessage();
	}
	break;

	default:
	$_SESSION["msg"] = "Ação Inválida, contate um administrador do sistema, Ação: $action";
	header("Location: http://" . $_SERVER["HTTP_HOST"] . "/Projeto/index.php");
	break;
}