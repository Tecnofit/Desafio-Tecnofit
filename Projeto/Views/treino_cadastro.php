<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Cadastro de Treino</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../Assets/css/main.css">
	<link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
</head>
<body>
	<?php 

	require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Exercicio.php");

	session_start(); 
	include $_SESSION["admin"] == 1 ? "../menu_admin.html" : "../menu.html";
	
	?>
	<div class="container">
		<div class="row">
			<div class="col-4">
				<form class="form-signin" action="../Controllers/TreinoControl.php?action=novo" method="POST">
					<div class="form-group row">
						<label for="labelNome">Nome</label>
						<input type="text" class="form-control" name="nome" id="idNome" placeholder="Digite o nome do Treino" required>
					</div>
					<?php
					
					$exercicios = Exercicio::listar();
					$listaExercicio = "<option value='0'>-- Selecione --</option>";
					
					foreach($exercicios as $exercicio){
						$listaExercicio .= "<option value='" . $exercicio->getCodigo() . "'>" . $exercicio->getNome() . "</option>";
					}

					for($i = 1; $i < 5; $i++){
						$html = "
						<div class='row'>
						<label for='labelLogin'>Sessões</label>
						<label class='offset-2' for='labelLogin'>Exercicio $i</label>
						</div>
						<div class='form-group row'>
						<input type='number' class='form-control col-2' name='sessao$i'>
						<select class='form-control col-9 offset-1' name='exercicio$i'>
						$listaExercicio
						</select>
						</div>";
						echo $html;
					}
					?>
					<div class="row">
						<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>