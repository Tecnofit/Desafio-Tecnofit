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

            <div id="divExercicio" name="divExercicio">             
                <?php $results = mysqli_query($connect, "SELECT nome,id_exercicio FROM tb_exercicio where ativo=1 order by nome asc"); ?>
                <table>
                    <caption><h3>Exercícios</h3></caption>
                    
                    <thead>
                        <tr>
                            <td class="esquerda" colspan="2">
                            <a href="frmExercicioIncluir.php"><img class="iconMini" src="img/add.png" />Inserir novo exercício</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    
                    <?php 
                    if(! mysqli_num_rows($results)){ ?>
                        <tr><td colspan="2"><i>Não há exercícios cadastrados</td></tr>
                    <?php 
                    } 
                    else{                        
                        while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <td><?=$row['nome']; ?></td>
                                <td>
                                    <a href="#" onclick="EnviaPost(0,'frmAlteraExercicio',<?=$row['id_exercicio']; ?>);" ><img class="iconMini" src="img/e.png" /></a>
                                    <a href="#" onclick="$.fn.ExcluirExercicio(<?=$row['id_exercicio']; ?>);"><img class="iconMini" src="img/d.png" /></a>
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
    $.fn.ExcluirExercicio = function(id){
        if(confirm("Confirma essa ação?")){
            $.get("ajax/ajaxExcluiExercicio.php", "id=" + id, function( data ) {
               //console.log(data);
                location.reload();
            });
        }
    };
});
</script>
