<?php
$acao = 'incluir';
$exercicio = array();
if($_GET['acao']){
	$acao = $_GET['acao'];
}
$id = '';
if(isset($_GET['id']) && $_GET['id'] > 0){
	$id = $_GET['id'];

	include 'DB.php';
	$db = new DB();
	$exercicio = $db->getRowById($id, 'exercicios');
}

$nome = isset($exercicio['nome']) ? $exercicio['nome'] : '';
$descricao = isset($exercicio['descricao']) ? $exercicio['descricao'] : '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Teste Dev - Hugo Almeida</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>

	<div id="principal">
		<form id="formulario" action="api_exercicio.php" method="post">
			<input type="hidden" name="id" id="id" value="<?=$id?>">
			<h1>Cadastro de Exercício</h1>

            Dados do Exercício:
            <div class="row">
                <div class="col-lg-12">
                    <input type="text" placeholder="Nome" name="nome" id="nome" value="<?=$nome?>">
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <textarea id="descricao" name="descricao" rows="10" style="width: 100%" placeholder="Descrição"><?=$descricao?></textarea>
                </div>
            </div>

            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="back-btn" class="back-btn" onclick="location.href='exercicios.php'";>Voltar</button>
                    <button type="button" id="save-btn" class="save-btn" onclick="salvar('<?=$acao?>', '<?=$id?>')">Salvar</button>
                </div>
            </div>

		</form>		
	</div>	

	<script>
        function validateForm() {
            var valid = true;

            if(document.getElementById('nome').value == ''){
                document.getElementById('nome').className = 'invalid';
                valid = false;
            }

            if(document.getElementById('descricao').value == ''){
                document.getElementById('descricao').className = 'invalid';
                valid = false;
            }

            return valid;
        }

		function salvar(tipo, id){
			id = (typeof id == "undefined")?'':id;
			var statusArr = {incluir:"adicionado",alterar:"alterado",deletar:"deletado"};

			$.ajax({
				type: 'POST',
				url: 'api_exercicio.php',
				data: {
					nome: document.getElementById('nome').value,
					descricao: document.getElementById('descricao').value,
					acao: tipo,
					id: document.getElementById('id').value
				},
				success:function(msg){
					console.log(msg);
					if(msg == 'ok'){
						alert('Exercício foi '+statusArr[tipo]+' com sucesso.');
					}else{
						alert('Ocorreu algum problema ao tentar salvar o registro.');
					}
					window.location.href = 'exercicios.php';
				}
			});
		}
	</script>
</body>
</html>