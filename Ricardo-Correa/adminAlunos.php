<?php
session_start();
include_once("incSeguranca.php");
include_once("incHeader.php");
?>

<form method="post" id="frmAdmin" name="frmAdmin">
    <input type="hidden" id="id" name="id" />
	<div class="container super">
        <div class="box grande">

<?php include_once("incPerfil.php"); ?>

            <h2>Módulo de Administração</h2>
            <a href="portalAdmin.php"><img class="iconMedio" src="img/voltar.png" /></a>
            <div id="divAluno" name="divAluno">             
                <?php $results = mysqli_query($connect, "SELECT id_aluno,nome,email FROM tb_aluno order by nome asc"); ?>
                <table>
                    <caption><h3>Alunos</h3></caption>
                    
                    <thead>
                        <tr>
                            <td class="esquerda" colspan="3">
                            <a href="frmAlunoIncluir.php"><img class="iconMini" src="img/add.png" />Inserir novo aluno</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Nome</th>
                            <th>E-Mail</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    
                    <?php 
                    if(! mysqli_num_rows($results)){ ?>
                        <tr><td colspan="3"><i>Não há Alunos cadastrados</td></tr>
                    <?php 
                    } 
                    else{                        
                        while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <td><?=$row['nome']; ?></td>
                                <td><?=$row['email']; ?></td>
                                <td>
                                    <a href="#" onclick="EnviaPost(0,'relAluno',<?=$row['id_aluno']; ?>);" ><img class="iconMini" src="img/v.png" /></a>
                                    <a href="#" onclick="EnviaPost(0,'frmAlteraAluno',<?=$row['id_aluno']; ?>);" ><img class="iconMini" src="img/e.png" /></a>
                                    <a href="#" onclick="$.fn.ExcluirAluno(<?=$row['id_aluno']; ?>);"><img class="iconMini" src="img/d.png" /></a>
                                </td>
                            </tr>
                    <?php 
                        }
                    } 
                    ?>
                </table>
            </div>
            <a href="portalAdmin.php"><img class="iconMedio" src="img/voltar.png" /></a>
        </div>
    </div>
</form>
<?php include_once("incFooter.php"); ?>

<script>
$(document).ready(function(){
    $.fn.ExcluirAluno = function(id){
        if(confirm("Confirma essa ação?")){
            $.get("ajax/ajaxExcluiAluno.php", "id=" + id, function( data ) {
               //console.log(data);
                location.reload();
            });
        }
    };
});
</script>
