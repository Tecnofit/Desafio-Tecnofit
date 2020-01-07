<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Projeto Tecnofit</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="Assets/css/main.css">
	<link rel="stylesheet" href="Assets/css/bootstrap.min.css">
</head>
<body>
	<?php 
	session_start();
	if(isset($_SESSION["msg"])){
		$msg = $_SESSION["msg"];
		$html = "<div class='alert alert-info text-center'><strong>$msg</strong></div>";
		echo $html;
	}
	session_destroy();
	?>
	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
				<div class="card card-signin my-5">
					<div class="card-body">
						<img class="img-fluid" src="Assets/images/Tecnofit.png" id="logo">
						<form class="form-signin" action="Controllers/UsuarioControl.php?action=login" method="POST">

							<div class="form-label-group">
								<label for="usuario">Usuario</label>
								<input type="text" id="idUsuario" name="usuario" class="form-control" placeholder="Digite seu usuario" required autofocus>
							</div><br>

							<div class="form-label-group">
								<label for="senha">Senha</label>
								<input type="password" id="idPassword" name="senha" class="form-control" placeholder="Digite sua senha" required>
							</div><br>

							<button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="Assets/main.css"></script>
</body>
</html>