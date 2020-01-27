<?php
session_start();
include_once("incSeguranca.php");
include_once("incHeader.php");
?>

<form method="post" id="frmAdmin" name="frmAdmin">
	<div class="container super">
        <div class="box grande">

<?php include_once("incPerfil.php"); ?>

            <h2>Módulo de Administração</h2>
            <a href="adminExercicios.php"><img class="iconMedio" src="img/voltar.png" /></a>

            <div id="divExercicio" name="divExercicio">
            <?php 
            $nome = "";
            $id = $_POST['id'];
            $results = mysqli_query($connect, "SELECT id_exercicio, nome FROM tb_exercicio where id_exercicio=$id;");
            while($row = mysqli_fetch_array($results)){
                $nome = $row['nome'];
            }
            ?>
                <p><h3>Editando Exercício</h3></p>
                <p>                                        
                    <input type="text" maxlength="100" id="txtExercicioNome" name="txtExercicioNome" value="<?=$nome?>" placeholder="Digite o nome do novo exercício" /><br /> 
                    <input type="hidden" name="id" id="id" value="<?=$id?>"/><br />                     
                    <button type="button" id="GravarExercicio">Gravar</button>
                    <button type="button" id="btnCancelarExercicio" class="bgRed" onclick="window.location.href='adminExercicios.php';">Cancelar</button>
                </p>
            </div>
			<a href="adminExercicios.php"><img class="iconMedio" src="img/voltar.png" /></a>
        </div>
    </div>
</form>
<?php include_once("incFooter.php"); ?>

<script>
$(document).ready(function(){
    $("#GravarExercicio").click(function(){
        if($("#txtExercicioNome").val() == ""){
            alert("Ação negada.\nÉ necessário preencher um nome.");
        }
        else{            
            $.get("ajax/ajaxAlteraExercicio.php", "id=" + $("#id").val() + "&nome=" + $("#txtExercicioNome").val() + "&id_treino=" + $("#txtTreino").val(), function( data ) {
                //console.log(data);
                window.location.href = "adminExercicios.php";
            });
        }
    });
});
</script>