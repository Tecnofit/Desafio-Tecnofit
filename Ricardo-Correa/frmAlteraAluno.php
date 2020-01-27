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
            <?php 
            $email = "";
            $nome = "";
            $idTreino = "";
            $id = $_POST['id'];
            $results = mysqli_query($connect, "SELECT nome, email, id_treino FROM tb_aluno where id_aluno=$id");
            while($row = mysqli_fetch_array($results)){
                $nome = $row['nome'];
                $email = $row['email'];
                $idTreino = $row['id_treino'];
                if(is_null($row['id_treino'])){ $idTreino = 0;} 
            }
            $resultsT = mysqli_query($connect, "SELECT id_treino, nome FROM tb_treino");
            ?>
                <p><h3>Editando Aluno</h3></p>
                <p>                                        
                    <input type="text" maxlength="100" id="txtAlunoNome" name="txtAlunoNome" value="<?=$nome?>" placeholder="Digite o nome do novo aluno" /><br /> 
                    <input type="email" maxlength="100" id="txtAlunoEmail" name="txtAlunoEmail" value="<?=$email?>" placeholder="Digite o e-mail do novo aluno" required/><br /> 
                    <select id="txtTreino" name="txtTreino">
                        <option value="0">Selecione um treino</option>
                        <?php
                            while($rowT = mysqli_fetch_array($resultsT)){?>
                                <option value="<?=$rowT['id_treino']?>" 
                                <?php
                                    if($idTreino == $rowT['id_treino']){
                                        echo " selected='selected' ";
                                    }
                                ?>
                                ><?=$rowT['nome']?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <input type="hidden" name="id" id="id" value="<?=$id?>"/><br />                     
                    <button type="button" id="GravarAluno">Gravar</button>
                    <button type="button" id="btnCancelarAluno" class="bgRed" onclick="window.location.href='adminAlunos.php';">Cancelar</button>
                </p>
            </div>
			<a href="adminAlunos.php"><img class="iconMedio" src="img/voltar.png" /></a>
        </div>
    </div>
</form>
<?php include_once("incFooter.php"); ?>

<script>
$(document).ready(function(){
    $("#GravarAluno").click(function(){
        if($("#txtAlunoNome").val() == "" || $("#txtAlunoEmail").val() == ""){
            alert("Ação negada.\nÉ necessário preencher os campos nome e e-mail.");
        }
        else{
            $.get("ajax/ajaxAlteraAluno.php", "id=" + $("#id").val() + "&nome=" + $("#txtAlunoNome").val() + "&email=" + $("#txtAlunoEmail").val() + "&id_treino=" + $("#txtTreino").val(), function( data ) {
                //console.log(data);
                window.location.href = "adminAlunos.php";
            });
        }
    });
});
$("#txtAlunoEmail").focus();
</script>