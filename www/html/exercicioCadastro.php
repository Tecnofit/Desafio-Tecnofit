<?php
include_once('../includes/conectai.inc.php');
include_once('../classes/Util.php');
include_once('../classes/Lista.php');

$upserting = array('SHOWERRO'=>'hide','MSG'=>'');
$idUp = '';
$res = array('nome'=>'');
$lista = new Lista;

if ($_POST) {
	$campos = array();
	foreach ($_POST as $key => $value) {
		$chave = Util::tratar($key);
		$valor = Util::tratar($value);
		$campos[$chave] = $valor;
	}

	$lista->tabela = 'exercicio';

	if (isset($campos['idUp'])) {
		$idUp = $campos['idUp'];
		unset($campos['idUp']);
		$upserting = $lista->upserting($campos, $idUp);
	} else {
		$upserting = $lista->upserting($campos);
	}

	if($upserting['STATUS']=='OK'){
		header("location: exercicio.php");
	}
}

if(isset($_GET['i'])){
	$idUp = Util::tratarNum(base64_decode($_GET['i']));
	$lista->consulta = "SELECT id, nome FROM exercicio WHERE id = ".$idUp;
	$result = $lista->dados();
	$res = mysqli_fetch_assoc($result['RES']);
}
//$sessoes = $lista->sessoesSelect($res['sessoes']);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>

</style>

<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">WebSiteName</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="alunoCadastro.php">+ Aluno</a></li>
				<li class="active"><a href="exercicioCadastro.php">+ Exercício</a></li>
				<li><a href="exercicio.php">Todos Exercicios</a></li>
			</ul>
		</div>
	</nav>
	<div class="jumbotron text-center">
		<h1>+ Cadastro de Exercícios</h1>
	</div>

	<div class="container">
		<div class="alert alert-danger <?=$upserting['MSG']?$upserting['SHOWERRO']:'hide'?>" role="alert">
		<?=$upserting['MSG'] ?>
		</div>
		<!-- CADASTRO DE EXERCICIO -->
		<p class="text-right">* Obrigatório</p>
		<form class="form-horizontal" method="post">
			<div class="form-group">
				<label class="control-label col-sm-2" for="nome">*Nome do Exercício:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nome" name="nome" autocomplete="off" value="<?=$res['nome']?>" required>
				</div>
			</div>
			<!--
			<div class="form-group">
				<label class="control-label col-sm-2" for="sessoes">*Quantidade de Sessões:</label>
				<div class="col-sm-10">
					<select class="form-select form-select-lg" id="sessoes" name="sessoes">
						<?=$sessoes?>
					</select>
				</div>
			</div>
			-->
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name="idUp" value="<?=$idUp?>">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</div>
		</form>
		<!-- FIM - CADASTRO DE EXERCICIO -->
	</div>

	<script src="js/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>