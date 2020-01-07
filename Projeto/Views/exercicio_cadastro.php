<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Cadastro de Exercício</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../Assets/css/main.css">
	<link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
</head>
<body>
	<?php 

	session_start(); 
	include $_SESSION["admin"] == 1 ? "../menu_admin.html" : "../menu.html";

	?>
	<div class="container">
		<div class="row">
			<div class="col-4">
				<form class="form-signin" action="../Controllers/ExercicioControl.php?action=novo" method="POST">
					<div class="form-group">
						<label for="labelNome">Nome</label>
						<input type="text" class="form-control" name="nome" id="idNome" placeholder="Digite o nome do exercicio">
					</div>
					<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>