<?php
include_once('../includes/conectai.inc.php');
include_once('../classes/Util.php');
include_once('../classes/Lista.php');

if (isset($_GET['i'])) {
	$idUp = Util::tratarNum(base64_decode($_GET['i']));
	$lista = new Lista;
	$lista->consulta = "SELECT id, nome FROM aluno WHERE id = " . $idUp . " ORDER BY nome ASC";
	$result = $lista->dados();
	$res = mysqli_fetch_assoc($result['RES']);
} else {
	header('index.php');
}
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
				<li class="active"><a href="index.php">Home</a></li>
				<li><a href="alunoCadastro.php">+ Aluno</a></li>
				<li><a href="exercicioCadastro.php">+ Exercício</a></li>
				<li><a href="exercicio.php">Todos Exercicios</a></li>
			</ul>
		</div>
	</nav>
	<div class="jumbotron text-center">
		<h1>Visualizando Treino</h1>
	</div>

	<div class="container">
		<!-- VER TREINO -->
		<h2>Aluno : <strong><?= $res['nome'] ?></strong></h2>
		<div class="row" id="carregando" style="background-color: #286090; color: #fff">
			<div class="col-sm-12 text-center">
				<h4>Carregando Treino...</h4>
			</div>
		</div>
		<div class="alert alert-warning hide" id="nenhum" role="alert">
			<strong>Atenção</strong>: Nenhum treino foi encontrado.
		</div>
		<div class="row" id="treino" style="display: none;">
			<div class="col-sm-6" style="border: 1px solid #f8f9fa; height: 200px;">
				<h4 style="color:#286090"><strong>Exercício Atual</strong></h4>
				<h3 id="s1_nome" class="text-center"></h3>
				<h4 class="text-center">Sessões Restante: <strong id="s1_qtd"></strong></h4>
				<div class="row">
					<div class="col-sm-6">
						<p><button type="button" id="finalizar" class="btn btn-success" value="">Finalizar</button></p>
					</div>
					<div class="col-sm-6 text-right">
						<p><button type="button" id="pular" class="btn btn-primary" value="">Pular Exercício</button></p>
					</div>
				</div>
			</div>
			<div class="col-sm-6" style="background-color: #f8f9fa; height: 200px;">
				<h4>Próximo Exercício</h4>
				<h3 id="s2_nome" class="text-center"></h3>
				<h4 class="text-center">Sessões Restante: <strong id="s2_qtd"></strong></h4>
			</div>
		</div>
		<!-- FIM VER TREINO -->
	</div>

	<script src="js/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			// CARREGAR TREINO
			function treino(idAluno, acao, idExe) {
				console.log('carrega treino: ' + idAluno + " - " + acao + " - " + idExe);
				var postForm = {
					"id": idAluno,
					"acao": acao,
					"idExe": idExe
				}
				$.ajax({
					type: "GET",
					url: "alunoTreino.js.php?_=" + new Date().getTime(),
					data: postForm,
					dataType: "json",
					success: function(data) {

						console.log("OK: " + data.success);
						$("#s1_nome").html(data.dados[0].nome);
						$("#s1_qtd").html(data.dados[0].sessoes);

						$("#s2_nome").html(data.dados[1].nome);
						$("#s2_qtd").html(data.dados[1].sessoes);

						$("#finalizar").val(data.dados[0].id);
						$("#pular").val(data.dados[1].id);

						$("#carregando").hide();
						$("#treino").show();

					},
					error: function(data) {
						console.log('SEM EXERCICIOS');
						$("#carregando").hide();
						$("#nenhum").attr('class', 'alert alert-warning');
						$("#treino").hide();
					}
				});
			}
			var idAluno = '<?= $idUp ?>';
			console.log('aluno: ' + idAluno);
			treino(idAluno, "", "");

			$("#finalizar").click(function() {
				$("#carregando").show();
				var finalizar = $(this).val();
				console.log('finalizar: ' + finalizar);
				treino(idAluno, "finalizar", finalizar);
			});

			$("#pular").click(function() {
				$("#carregando").show();
				var proximo = $(this).val();
				console.log('pular: ' + proximo);
				treino(idAluno, "pular", proximo);
			});
		});
	</script>
</body>

</html>