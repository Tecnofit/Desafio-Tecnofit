<?php
include_once('../includes/conectai.inc.php');
include_once('../classes/Lista.php');

$lista = new Lista;
$lista->consulta = "SELECT id, nome, DATE_FORMAT(dtCria,'%d-%m-%Y %H:%i:%s') AS dtCria, DATE_FORMAT(dtAcao,'%d-%m-%Y %H:%i:%s') AS dtAcao
FROM aluno
WHERE ativo = 1 ORDER BY nome ASC";

$result = $lista->dados();
$tbLista = '';
$num = 1;
$sessoesAtivas = '';

while($res = mysqli_fetch_assoc($result['RES'])){
	$treino = $lista->alunoTreino($res['id']);
	$tbLista .= '<tr id="tr'.$res['id'].'">';
	$tbLista .= '<td>'.$num.'</td>';
	$tbLista .= '<td id="nr'.$res['id'].'">'.$res['nome'].'</td>';
	$tbLista .= '<td><ul class="treino">'.$treino.'</ul></td>';
	$tbLista .= '<td><a href="alunoTreino.php?i='.base64_encode($res['id']).'" class="btn btn-info">Ver Treino</a></td>';
	$tbLista .= '<td><a href="alunoCadastro.php?i='.base64_encode($res['id']).'" class="btn btn-primary">Editar</button></td>';
	$tbLista .= '<td><button type="button" id="r'.$res['id'].'" class="btn btn-danger btRem">Remover</button></td>';
	$tbLista .= '</tr>';
	$num++;
//echo '<pre>'.print_r($res,1).'</pre>';
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
	ul.treino {
		padding-left: 0;
	}

	ul.treino li {
		list-style: none;
		border-bottom: 1px dotted #ccc;
		font-size: 12px;
	}

	span.badge {
		display: inline-block;
		padding: 2px 6px;
		background-color: #000;
		color: #fff;
		font-size: 12px;
		margin-right: 10px;
	}

	li.text-muted span.badge {
		background-color: #28a745 !important;
	}

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
		<h1>Home</h1>
	</div>

	<div class="container">
		<!-- HOME -->
		<h2>Alunos</h2>
		<p class="text-right">* Treino finalizado</p>
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Nome</th>
					<th>Sessões - Exercicio</th>
					<th>Ver Treino</th>
					<th>Editar</th>
					<th>Remover</th>
				</tr>
			</thead>
			<tbody>
				<?=$tbLista?>
			</tbody>
		</table>
		<!-- FIM HOME -->

	</div>

	<script src="js/jquery/3.5.1/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			// REMOVER
			$(".btRem").click(function() {
				var idbt = $(this).attr('id');
				var descricao = $('#n'+idbt).html();
				console.log("bt = "+idbt + " : "+descricao);

				if (confirm("Confirmar a remoção do Aluno - " + descricao + " ?" )) {
					$(this).html("Removendo...");
					$(this).prop("disabled", true);

					var postForm = {
						"id": idbt,
						"tipo": "alu"
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