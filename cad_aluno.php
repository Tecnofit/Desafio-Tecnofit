<?php
$acao = 'incluir';
$pessoa = array();
if($_GET['acao']){
	$acao = $_GET['acao'];
}
$id = '';
if(isset($_GET['id']) && $_GET['id'] > 0){
	$id = $_GET['id'];

	include 'DB.php';
	$db = new DB();
	$pessoa = $db->getRowById($id, 'alunos');
}

$nome = isset($pessoa['nome']) ? $pessoa['nome'] : '';
$dt_nascimento = isset($pessoa['dt_nascimento']) ? $pessoa['dt_nascimento'] : '';
$nasc = substr($dt_nascimento, 0, 4 ).'-'.substr($dt_nascimento, 5, 2).'-'.substr($dt_nascimento, 8, 2);
$endereco = isset($pessoa['endereco']) ? $pessoa['endereco'] : '';
$numero = isset($pessoa['numero']) ? $pessoa['numero'] : '';
$cep = isset($pessoa['cep']) ? $pessoa['cep'] : '';
$bairro = isset($pessoa['bairro']) ? $pessoa['bairro'] : '';
$uf = isset($pessoa['uf']) ? $pessoa['uf'] : '';
$cidade = isset($pessoa['cidade']) ? $pessoa['cidade'] : '';
$telefone = isset($pessoa['telefone']) ? $pessoa['telefone'] : '';
$celular = isset($pessoa['celular']) ? $pessoa['celular'] : '';
$email = isset($pessoa['email']) ? $pessoa['email'] : '';
$status = isset($pessoa['status']) ? $pessoa['status'] : '';
$treino_atual = isset($pessoa['treino_atual']) ? $pessoa['treino_atual'] : '';

$treinos = $db->getRows('treinos');
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
		<form id="formulario" action="api.php" method="post">
			<input type="hidden" name="id" id="id" value="<?=$id?>">
			<h1>Cadastro de Aluno</h1>

            <div class="row" style="margin-left: 0px">
                Status da matrícula:
                <div class="col-lg-3">
                    <select name="status" id="status">
                        <option value="a" <?= $status == 'a' ? 'selected' : ''?>>Ativo</option>
                        <option value="i" <?= $status == 'i' ? 'selected' : ''?>>Inativo</option>
                    </select>
                </div>
                Treino atual:
                <div class="col-lg-3">
                    <select name="treino_atual" id="treino_atual">
                        <?php foreach($treinos as $t){ ?>
                            <option value="<?php echo $t['id']; ?>"><?php echo $t['nome']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

			Dados Pessoais:
            <div class="row">
                <div class="col-lg-8">
                    <input type="text" placeholder="Nome" name="nome" id="nome" value="<?=$nome?>">
                </div>
                <div class="col-lg-4">
                    <input type="date" placeholder="Data de Nascimento" name="dt_nascimento" id="dt_nascimento" value="<?=$nasc;?>">
                </div>
            </div>

            Dados de Endereço:
            <div class="row">
                <div class="col-lg-3">
                    <input type="text" placeholder="CEP" name="cep" id="cep" onkeypress="mascara(this, '#####-###')" value="<?=$cep?>">
                </div>
                <div class="col-lg-7">
                    <input type="text" placeholder="Endereço" name="endereco" id="endereco" value="<?=$endereco?>">
                </div>
                <div class="col-lg-2">
                    <input type="text" placeholder="Número" name="numero" id="numero" value="<?=$numero?>">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    <input type="text" placeholder="Bairro" name="bairro" id="bairro" value="<?=$bairro?>">
                </div>
                <div class="col-lg-2">
                    <input type="text" placeholder="UF" name="uf" id="uf" value="<?=$uf?>">
                </div>
                <div class="col-lg-5">
                    <input type="text" placeholder="Cidade" name="cidade" id="cidade" value="<?=$cidade?>">
                </div>
            </div>

            Contatos:
            <div class="row">
                <div class="col-lg-3">
                    <input type="text" placeholder="Telefone Fixo" name="telefone" id="telefone" onkeypress="mascara(this, '## ####-####')" maxlength="13" value="<?=$telefone?>">
                </div>
                <div class="col-lg-3">
                    <input type="text" placeholder="Telefone Celular" name="celular" id="celular" onkeypress="mascara(this, '## ####-####')" maxlength="13" value="<?=$celular?>">
                </div>
                <div class="col-lg-6">
                    <input type="email" placeholder="Email" name="email" id="email" value="<?=$email?>">
                </div>
            </div>

            <div style="overflow:auto;">
                <div style="float:right;">
                    <button type="button" id="back-btn" class="back-btn" onclick="location.href='alunos.php'";>Voltar</button>
                    <button type="button" id="save-btn" class="save-btn" onclick="salvarAluno('<?=$acao?>', '<?=$id?>')">Salvar</button>
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

            if(document.getElementById('dt_nascimento').value == ''){
                document.getElementById('dt_nascimento').className = 'invalid';
                valid = false;
            }

            if(document.getElementById('cep').value == ''){
                document.getElementById('cep').className = 'invalid';
                valid = false;
            }

            if(document.getElementById('endereco').value == ''){
                document.getElementById('endereco').className = 'invalid';
                valid = false;
            }

            if(document.getElementById('numero').value == ''){
                document.getElementById('numero').className = 'invalid';
                valid = false;
            }

			return valid;
		}

		function salvarAluno(tipo, id){
			id = (typeof id == "undefined")?'':id;
			var statusArr = {incluir:"adicionado",alterar:"alterado",deletar:"deletado"};

			$.ajax({
				type: 'POST',
				url: 'api.php',
				data: {
					nome: document.getElementById('nome').value,
					status: document.getElementById('status').value,
					dt_nascimento: document.getElementById('dt_nascimento').value,
					cep: document.getElementById('cep').value,
					endereco: document.getElementById('endereco').value,
					numero: document.getElementById('numero').value,
					bairro: document.getElementById('bairro').value,
					uf: document.getElementById('uf').value,
					cidade: document.getElementById('cidade').value,
					telefone: document.getElementById('telefone').value,
					celular: document.getElementById('celular').value,
                    email: document.getElementById('email').value,
					acao: tipo,
					id: document.getElementById('id').value,
                    treino_atual: document.getElementById('treino_atual').value
				},
				success:function(msg){
					console.log(msg);
					if(msg == 'ok'){
						alert('Aluno foi '+statusArr[tipo]+' com sucesso.');
					}else{
					    console.info(msg)
						alert('Ocorreu algum problema ao tentar salvar o registro.');
					}
					window.location.href = 'alunos.php';
				}
			});
		}

        function mascara(t, mask){
            var i = t.value.length;
            var saida = mask.substring(1,0);
            var texto = mask.substring(i)
            if (texto.substring(0,1) != saida){
                t.value += texto.substring(0,1);
            }
        }
	</script>
</body>
</html>