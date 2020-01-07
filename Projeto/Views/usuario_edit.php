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

	require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Usuario.php");
	
	session_start();
	include $_SESSION["admin"] == 1 ? "../menu_admin.html" : "../menu.html";

	$codigo = $_GET["codigo"];
	$usuario = new Usuario();
	$usuario = $usuario->buscar($codigo);
	
	?>
	<div class="container">
		<div class="row">
			<div class="col-4">
				<form class="form-signin" action="../Controllers/UsuarioControl.php?action=edit" method="POST">
					<input type="hidden" id="idCodigo" name="codigo" value="<?php echo $codigo ?>">
					<div class="form-group">
						<label for="labelNome">Nome</label>
						<input type="text" class="form-control" name="nome" value="<?php echo $usuario->getNome(); ?>" id="idNome" placeholder="Digite seu nome">
					</div>
					<div class="form-group">
						<label for="labelLogin">Login</label>
						<input type="text" class="form-control" name="login" value="<?php echo $usuario->getLogin(); ?>" id="idLogin" placeholder="Digite seu login" required>
					</div>
					<div class="form-group">
						<label for="labelSenha">Senha</label>
						<input type="password" class="form-control" name="senha" id="idSenha" placeholder="Digite sua senha" required>
					</div>
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" name="admin" id="exampleCheck1">
						<label class="form-check-label" for="exampleCheck1">Administrador</label>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Editar</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>