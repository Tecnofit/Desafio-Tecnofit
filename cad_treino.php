<?php
include 'DB.php';
$db = new DB();

$acao = 'incluir';
$treino = array();
if($_GET['acao']){
	$acao = $_GET['acao'];
}
$id = '';
$exerciciosTreino = array();
if(isset($_GET['id']) && $_GET['id'] > 0){
	$id = $_GET['id'];


	$treino = $db->getRowById($id, 'treinos');

    $sql = "SELECT a.*, b.nome FROM exercicios_treino a JOIN exercicios b on a.id_exercicio = b.id where a.id_treino = '$id'";
    $result = $db->execute($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $exerciciosTreino[] = $row;
        }
    }
}

$nome = isset($treino['nome']) ? $treino['nome'] : '';
$descricao = isset($treino['descricao']) ? $treino['descricao'] : '';
$repeticoes = isset($treino['repeticoes']) ? $treino['repeticoes'] : '';
$status = isset($treino['status']) ? $treino['status'] : '';

$exercicios = $db->getRows('exercicios');
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
		<form id="formulario" action="api_treino.php" method="post">
			<input type="hidden" name="id" id="id" value="<?=$id?>">
			<h1>Cadastro de Treino</h1>

            <div class="row" style="margin-left: 0px">
                Status do treino:
                <div class="col-lg-3">
                    <select name="status" id="status">
                        <option value="a">Ativo</option>
                        <option value="i">Inativo</option>
                    </select>
                </div>
            </div>

			Dados do Treino:
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

            Exercícios:
            <div class="row">
                <div class="col-lg-3">
                    <select id="exercicio" name="exercicio">
                        <?php foreach($exercicios as $e){ ?>
                            <option value="<?php echo $e['id']; ?>"><?php echo $e['nome']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-lg-4">
                    Repetições: <input type="number" id="repeticoes" name="repeticoes" min="1" max="30" style="width: 100px;"/>
                </div>
                <div class="col-lg-2">
                    <button type="button" id="save-btn" class="save-btn" onclick="addExercicio()">Adicionar</button>
                </div>
            </div>
            <table class="table table-striped table-hover" id="tb_exercicio">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Repetições</th>
                    <th>Excluir</th>
                </tr>
                </thead>
                <tbody id="exerciciosData">
                </tbody>
            </table>

            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="back-btn" class="back-btn" onclick="location.href='treinos.php'";>Voltar</button>
                    <button type="button" id="save-btn" class="save-btn" onclick="salvar('<?=$acao?>', '<?=$id?>')">Salvar</button>
                </div>
            </div>

		</form>		
	</div>	

	<script>

        $( document ).ready(function() {
            exercicioArr = <?php echo json_encode($exerciciosTreino); ?>;
            console.info(exercicioArr);
            makeTable(exercicioArr);
           /* var id_treino = document.getElementById('id').value
            if(id_treino > 0) {
                $.ajax({
                    type: 'POST',
                    url: 'api_treino.php',
                    data: {
                        id_treino: id_treino,
                        acao: 'busca_treino'
                    },
                    success: function (arr) {
                        console.log(arr);
                        exercicioArr = arr;
                        makeTable(exercicioArr);
                    },
                    dataType: 'json'
                });
            }*/
        });

        var exercicioArr = [];

        function makeTable(array) {
            var tr, td;

            var tbody = document.getElementById('exerciciosData');

            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }

            for(var i = 0; i < array.length; i++){
                tr = document.createElement('tr'),

                td = document.createElement('td');
                td.innerHTML = array[i]['id_exercicio'];
                tr.appendChild(td);

                td = document.createElement('td');
                td.innerHTML = array[i]['nome'];
                tr.appendChild(td);

                td = document.createElement('td');
                td.innerHTML = array[i]['repeticoes'];
                tr.appendChild(td);

                td = document.createElement('td');
                td.innerHTML = '<a href="javascript:void(0);" data-toggle="tooltip" title="Excluir" class="glyphicon glyphicon-trash" onclick="deletarExercicioArr('+i+')">Excluir</a>';
                tr.appendChild(td);

                tbody.appendChild(tr);
            }
        }

        function deletarExercicioArr(index){
            exercicioArr.splice(index, 1);
            makeTable(exercicioArr);
        }

        function addExercicio(){
            id = $('#exercicio').val();
            nome = $('#exercicio option:selected').text();
            reps = $('#repeticoes').val();

            var o = {};
            o.id_exercicio = id;
            o.nome = nome;
            o.repeticoes = reps;

            exercicioArr.push(o);

            makeTable(exercicioArr);
        }

		function validateForm() {
			var valid = true;

            if(document.getElementById('status').value == ''){
                document.getElementById('status').className = 'invalid';
                valid = false;
            }

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
            if (!validateForm()) return false;

			id = (typeof id == "undefined")?'':id;
			var statusArr = {incluir:"adicionado",alterar:"alterado",deletar:"deletado"};

			$.ajax({
				type: 'POST',
				url: 'api_treino.php',
				data: {
					nome: document.getElementById('nome').value,
					descricao: document.getElementById('descricao').value,
					status: document.getElementById('status').value,
					acao: tipo,
					id: document.getElementById('id').value,
                    exercicios: exercicioArr
				},
				success:function(msg){
					console.info( msg)
					if(msg == 'ok'){
						alert('Treino foi '+statusArr[tipo]+' com sucesso.');
					}else{
						alert('Ocorreu algum problema ao tentar salvar o registro.');
					}
					window.location.href = 'treinos.php';
				}
			});
		}
	</script>
</body>
</html>