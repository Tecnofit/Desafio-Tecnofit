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
$id_treino = isset($pessoa['treino_ativo']) ? $pessoa['treino_ativo'] : '';


$sql = "SELECT a.*, b.nome FROM exercicios_treino a JOIN exercicios b on a.id_exercicio = b.id where a.id_treino = '$id_treino'";
$result = $db->execute($sql);
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $exerciciosTreino[] = $row;
    }
}
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
    <table class="table table-striped table-hover" id="tb_exercicio">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Repetições</th>
            <th>Finalizar</th>
            <th>Pular</th>
        </tr>
        </thead>
        <tbody id="exerciciosData">
        <tr>
            <td><?= $exerciciosTreino['id']; ?></td>
            <td><?= $exerciciosTreino['nome']; ?></td>
            <td><?= $exerciciosTreino['repeticoes']; ?></td>
            <td>
                <button class="back-btn" onclick="finalizar('<?=$pessoa['id'];?>')">Finalizar</button>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<script>


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
</script>
</body>
</html>