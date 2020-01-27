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
            <a href="adminExercicios.php">Voltar</a>

            <div id="divExercício" name="divExercicio">
                <p><h3>Novo Exercício</h3></p>
                <p>                                        
                    <input type="text" maxlength="100" id="txtExercicioNome" name="txtExercicioNome" placeholder="Digite o nome do novo exercício" />
                    <input type="hidden" id="id" name="id" /><br />
                    <button type="button" id="GravarNovoExercicio">Gravar</button>
                    <button type="button" id="btnCancelarNovoExercicio" class="bgRed" onclick="history.go(-1);">Cancelar</button>
                </p>
            </div>
			<a href="adminExercicio.php">Voltar</a>
        </div>
    </div>
</form>
<?php include_once("incFooter.php"); ?>

<script>
$(document).ready(function(){
    $("#GravarNovoExercicio").click(function(){
        if($("#txtExercicioNome").val() == ""){
            alert("Ação negada.\nÉ necessário preencher um nome.");
        }
        else{
        $.get("ajax/ajaxNovoExercicio.php", "nome=" + $("#txtExercicioNome").val(), function( data ) {
                window.location.href='adminExercicios.php';
            });
        }
    });
});
</script>