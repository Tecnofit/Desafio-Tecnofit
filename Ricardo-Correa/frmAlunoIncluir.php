<?php
session_start();
include_once("incSeguranca.php");
include_once("incHeader.php");
?>

<form method="post" id="frmAdmin" name="frmAdmin">
	<div class="container super">
        <div class="box grande">

<?php include_once("incHeader.php"); ?>

            <h2>Módulo de Administração</h2>
            <a href="adminAlunos.php"><img class="iconMedio" src="img/voltar.png" /></a>

            <div id="divAluno" name="divAluno">
                <p><h3>Novo Aluno</h3></p>
                <p>                                        
                    <input type="text" maxlength="100" id="txtAlunoNome" name="txtAlunoNome" placeholder="Digite o nome do novo aluno" />
                    <input type="hidden" id="id" name="id" /><br/>
                    <button type="button" id="GravarNovoAluno">Gravar</button>
                    <button type="button" id="btnCancelarNovoAluno" class="bgRed" onclick="history.go(-1);">Cancelar</button>
                </p>
            </div>
			<a href="adminAlunos.php"><img class="iconMedio" src="img/voltar.png" /></a>
        </div>
    </div>
</form>
<?php include_once("incHeader.php"); ?>

<script>
$(document).ready(function(){
    $("#GravarNovoAluno").click(function(){
        if($("#txtAlunoNome").val() == ""){
            alert("Ação negada.\nÉ necessário preencher um nome.");
        }
        else{
            $.get("ajax/ajaxNovoAluno.php", "nome=" + $("#txtAlunoNome").val(), function( data ) {
                //console.log(data);
                var d = data.replace("string(2) ","").replace('"','').replace('"','');
                EnviaPost(0, "frmAlteraAluno", d);
            });
        }
    });
});
</script>