<?php
include_once('../includes/conectai.inc.php');
include_once('../classes/Util.php');
include_once('../classes/Lista.php');

$upserting = array('SHOWERRO' => 'hide', 'MSG' => '');
$idUp = '';
$erro = '';
$res = array('nome' => '', 'sessoes' => '');
$exercicios = array();

if (isset($_POST['nome'])) {
	//echo '<pre>'.print_r($_POST,1).'</pre>';
	//die();
	foreach ($_POST as $key => $value) {
		if ($key != 'exercicios') {
			$chave = Util::tratar($key);
			$valor = Util::tratar($value);
			$campos[$chave] = $valor;
		}
	}

	$lista = new Lista;

	if (!isset($campos['idUp'])) {
		$lista->consulta = "SELECT id FROM aluno WHERE nome='" . $campos['nome'] . "'";
		$result = $lista->dados();
		$resEx = mysqli_fetch_assoc($result['RES']);
		if (isset($resEx['id'])) {
			// aluno existe
			$erro = $nome;
		}
	}

	if (!$erro) {
		$lista->tabela = 'aluno';
		// ATUALIZA ALUNO
		if (isset($campos['idUp'])) {
			$idUp = $campos['idUp'];
			unset($campos['idUp']);
			$upserting = $lista->upserting($campos, $idUp);
		} else {
			// NOVO ALUNO
			$upserting = $lista->upserting($campos);
		}

		if (isset($_POST['exercicios'])) {
			foreach ($_POST['exercicios'] as $key => $value) {
				$chave = Util::tratar($key);
				$valor = Util::tratar($value);
				if ($valor) {
					$exercicios[$chave] = $valor;
				}
			}

			// Atualiza Exercicios
			$lista->atualizaTreino($exercicios, $upserting['ID']);
		}

		if ($upserting['STATUS'] == 'OK') {
			header("location: index.php");
		}
	}
}

if (isset($_GET['i'])) {
	$idUp = Util::tratarNum(base64_decode($_GET['i']));
	$lista = new Lista;
	$lista->consulta = "SELECT id, nome FROM aluno WHERE id = " . $idUp . "";
	$result = $lista->dados();
	$res = mysqli_fetch_assoc($result['RES']);
	//$sessoes = $lista->sessoesSelect($res['sessoes']);
}

$lista = new Lista;
$exerciciosCheck = $lista->exerciciosCheck($idUp);
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
	label.form-check-label {
		padding-left: 10px;
	}
</style>

<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">WebSiteName</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li class="active"><a href="alunoCadastro.php">+ Aluno</a></li>
				<li><a href="exercicioCadastro.php">+ Exercício</a></li>
				<li><a href="exercicio.php">Todos Exercicios</a></li>
			</ul>
		</div>
	</nav>
	<div class="jumbotron text-center">
		<h1>Cadastro de Aluno</h1>
	</div>

	<div class="container">
		<!-- CADASTRO DE ALUNO -->
		<div class="alert alert-warning <?= ($erro ? '' : 'hide') ?>" role="alert">
			<strong>Atenção</strong>: O aluno <strong><?= $nome ?></strong> consta como cadastrado.
		</div>
		<form class="form-horizontal" method="post">
			<div class="form-group">
				<label class="control-label col-sm-2" for="email">Nome</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nome" name="nome" autocomplete="off" value="<?= $res['nome'] ?>" required>
				</div>
			</div>
			<fieldset class="form-group row">
				<label class="control-label col-sm-2">Selecione os Exercícios (Quantidade de Sessões)</label>
				<div class="col-sm-10">
					<?= $exerciciosCheck ?>
				</div>
			</fieldset>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" name="idUp" value="<?= $idUp ?>">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</div>
		</form>
		<!-- FIM - CADASTRO DE ALUNO -->
	</div>

	<script src="js/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>