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
            <a href="adminTreinos.php"><img class="iconMedio" src="img/voltar.png" /></a>

            <div id="divTreino" name="divTreino">
                <p><h3>Novo Treino</h3></p>
                <p>                                        
                    <input type="text" maxlength="100" id="txtTreinoNome" name="txtTreinoNome" placeholder="Digite o nome do novo treino" /><br/>
                    <input type="number" maxlength="4" id="txtSeries" name="txtSeries" placeholder="Series" value="0" />
                    <input type="hidden" id="id" name="id" /><br />
                    <button type="button" id="GravarNovoTreino">Gravar</button>
                    <button type="button" id="btnCancelarNovoTreino" class="bgRed" onclick="history.go(-1);">Cancelar</button>
                </p>
            </div>
			<a href="adminTreinos.php"><img class="iconMedio" src="img/voltar.png" /></a>
        </div>
    </div>
</form>
<?php include_once("incHeader.php"); ?>

<script>
$(document).ready(function(){
    $("#GravarNovoTreino").click(function(){
        if($("#txtTreinoNome").val() == "" || $("#txtSeries").val() == ""){
            alert("Ação negada.\nÉ necessário preencher um nome e uma quantidade.");
        }
        else{
            //header("Location: ajax/ajaxNovoTreino.php?nome=" + $("#txtTreinoNome").val() + "&series=" + $("#txtSeries").val());
            $.get("ajax/ajaxNovoTreino.php", "nome=" + $("#txtTreinoNome").val() + "&series=" + $("#txtSeries").val(), function( data ) {
                //console.log(data);
                var d = data.replace("string(2) ","").replace('"','').replace('"','');
                EnviaPost(0, "frmAlteraTreino", d);          
            });
        }
    });
});
</script>