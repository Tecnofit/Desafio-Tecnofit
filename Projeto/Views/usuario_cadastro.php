<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Cadastro de Usuário</title>
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
				<form class="form-signin" action="../Controllers/UsuarioControl.php?action=novo" method="POST">
					<div class="form-group">
						<label for="labelNome">Nome</label>
						<input type="text" class="form-control" name="nome" id="idNome" placeholder="Digite o nome do usuário" required>
					</div>
					<div class="form-group">
						<label for="labelLogin">Login</label>
						<input type="text" class="form-control" name="login" id="idLogin" placeholder="Digite o login do usuário" required>
					</div>
					<div class="form-group">
						<label for="labelSenha">Senha</label>
						<input type="password" class="form-control" name="senha" id="idSenha" placeholder="Digite a senha do usuário" required>
					</div>
					<div class="form-group form-check">
						<input type="checkbox" class="form-check-input" name="admin" id="exampleCheck1">
						<label class="form-check-label" for="exampleCheck1">Administrador</label>
					</div>
					<button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>