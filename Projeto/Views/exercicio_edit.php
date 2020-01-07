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

	require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Exercicio.php");

	session_start();
	include $_SESSION["admin"] == 1 ? "../menu_admin.html" : "../menu.html";

	$codigo = $_GET["codigo"];
	$exercicio = new Exercicio();
	$exercicio = $exercicio->buscar($codigo);
	
	?>
	<div class="container">
		<div class="row">
			<div class="col-4">
				<form class="form-signin" action="../Controllers/ExercicioControl.php?action=edit" method="POST">
					<input type="hidden" id="idCodigo" name="codigo" value="<?php echo $codigo ?>">
					<div class="form-group">
						<label for="labelNome">Nome</label>
						<input type="text" class="form-control" name="nome" value="<?php echo $exercicio->getNome(); ?>" id="idNome" placeholder="Digite seu nome">
					</div>
					<button type="submit" class="btn btn-primary btn-block">Editar</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>