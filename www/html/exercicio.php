<?php
include_once('../includes/conectai.inc.php');
include_once('../classes/Lista.php');

$lista = new Lista;
$lista->consulta = "SELECT id, nome, DATE_FORMAT(dtCria,'%d-%m-%Y %H:%i:%s') AS dtCria, DATE_FORMAT(dtAcao,'%d-%m-%Y %H:%i:%s') AS dtAcao FROM exercicio WHERE ativo = 1 ORDER BY nome ASC";
$result = $lista->dados();
$tabela = '';
$num = 1;

while ($res = mysqli_fetch_assoc($result['RES'])) {
	$lista->consulta = "SELECT t.idExercicio FROM treino t LEFT JOIN aluno a on (a.id = t.idAluno) WHERE t.idExercicio = '" . $res['id'] . "' AND  t.finalizado = 0 AND a.ativo = 1 ORDER BY t.idExercicio ASC";
	$resultSessoes = $lista->dados();
	$sessoesAtivas = mysqli_num_rows($resultSessoes['RES']);
	if ($sessoesAtivas>0) {
		$qtdSessoes = $sessoesAtivas;
	} else {
		$qtdSessoes = '-';
	}

	$tabela .= '<tr id="tr' . $res['id'] . '">';
	$tabela .= '<td>' . $num . '</td>';
	$tabela .= '<td id="nr' . $res['id'] . '">' . $res['nome'] . '</td>';
	$tabela .= '<td>' . $qtdSessoes . '</td>';
	$tabela .= '<td>' . $res['dtCria'] . '</td>';
	$tabela .= '<td>' . ($res['dtAcao'] ? $res['dtAcao'] : '-') . '</td>';
	$tabela .= '<td><a href="exercicioCadastro.php?i=' . base64_encode($res['id']) . '" class="btn btn-primary">Editar</button></td>';
	if (is_numeric($qtdSessoes)) {
		$tabela .= '<td></td>';
	} else {
		$tabela .= '<td><button type="button" id="r' . $res['id'] . '" class="btn btn-danger btRem">Remover</button></td>';
	}
	$tabela .= '</tr>';
	$num++;
	//echo '<pre>'.print_r($res,1).'</pre>';
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
	<title>Exercício</title>
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
				<li><a href="exercicioCadastro.php">+ Exercício</a></li>
				<li class="active"><a href="exercicio.php">Todos Exercicios</a></li>
			</ul>
		</div>
	</nav>
	<div class="jumbotron text-center">
		<h1>Lista Exercícios</h1>
	</div>

	<div class="container">

		<!-- LISTA EXERCICIO -->
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Exercício</th>
					<th>Treino ativo</th>
					<th>Data Criação</th>
					<th>Data Modificação</th>
					<th>Editar</th>
					<th>Remover</th>
				</tr>
			</thead>
			<tbody>
				<?= $tabela ?>
			</tbody>
		</table>
		<!-- FIM LISTA EXERCICIO -->
	</div>

	<script src="js/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			// REMOVER
			$(".btRem").click(function() {
				var idbt = $(this).attr('id');
				var descricao = $('#n' + idbt).html();
				console.log("bt = " + idbt + " : " + descricao);

				if (confirm("Confirmar a remoção do Exercício - " + descricao + " ?")) {
					$(this).html("Removendo...");
					$(this).prop("disabled", true);

					var postForm = {
						"id": idbt,
						"tipo": "exe"
					}
					$.ajax({ //Process the form using $.ajax()
						type: "POST",
						url: "remover.js.php",
						data: postForm,
						dataType: "json",
						success: function(data) {
							if (!data.success) {
								console.log("ERRO: " + data.msg);
								$(this).html("Erro...");
								$(this).prop("disabled", false);
							} else {
								$("#t" + idbt).hide();
								console.log("OK");

							}
						}
					});
					event.preventDefault();
				}
			});
		});
	</script>
</body>

</html>