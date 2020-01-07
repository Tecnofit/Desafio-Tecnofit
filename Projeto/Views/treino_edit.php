<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Edição de Usuário</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../Assets/css/main.css">
	<link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
</head>
<body>
	<?php 

	require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Treino.php");
	require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Exercicio.php");

	session_start();
	include $_SESSION["admin"] == 1 ? "../menu_admin.html" : "../menu.html";

	$codigo = $_GET["codigo"];
	$treino = new Treino();
	$treino = $treino->buscar($codigo);
	$exerciciosSessoes = Treino::buscaTreinoExercicio($codigo);

	?>
	<div class="container">
		<div class="row">
			<div class="col-4">
				<form class="form-signin" action="../Controllers/TreinoControl.php?action=edit" method="POST">
					<input type="hidden" id="idCodigo" name="codigo" value="<?php echo $codigo ?>">
					<div class="form-group row">
						<label for="labelNome">Nome</label>
						<input type="text" class="form-control" name="nome" value="<?php echo $treino->getNome(); ?>" id="idNome" placeholder="Digite seu nome">
					</div>
					<?php
					
					$exercicios = Exercicio::listar();
					$sessoes = [];
					$listaExercicios = [];

					$listaExercicio = "<option value='0'>-- Selecione --</option>";
					foreach($exercicios as $exercicio){
						$listaExercicio .= "<option value='" . $exercicio->getCodigo() . "'>" . $exercicio->getNome() . "</option>";
					}

					foreach($exerciciosSessoes as $exercicioSessao){
						$arrExercSess = explode(":", $exercicioSessao);
						$carregaExercicio = "<option value='0'>-- Selecione --</option>";
						foreach($exercicios as $exercicio){
							if($arrExercSess[2] == $exercicio->getCodigo()){
								$carregaExercicio .= "<option value='" . $exercicio->getCodigo() . "' selected>" . $exercicio->getNome() . "</option>";
							} else {
								$carregaExercicio .= "<option value='" . $exercicio->getCodigo() . "'>" . $exercicio->getNome() . "</option>";
							}
						}
						array_push($listaExercicios, $carregaExercicio);
						array_push($sessoes, $arrExercSess[1]);
					}

					for($i = 1; $i < 5; $i++){
						$valueSessao = "";
						$htmlExercicio = "";

						if(!empty($sessoes[$i-1])){
							$valueSessao = $sessoes[$i-1];
						}
						$htmlExercicio = empty($listaExercicios[$i-1]) ? $listaExercicio : $listaExercicios[$i-1];
						$html = "
						<div class='row'>
						<label for='labelLogin'>Sessões</label>
						<label class='offset-2' for='labelLogin'>Exercicio $i</label>
						</div>
						<div class='form-group row'>
						<input type='number' class='form-control col-2' name='sessao$i' value=" . $valueSessao . ">
						<select class='form-control col-9 offset-1' name='exercicio$i'>
						$htmlExercicio
						</select>
						</div>";
						echo $html;
					}
					
					?>
					<div class="row">
						<button type="submit" class="btn btn-primary btn-block">Editar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>