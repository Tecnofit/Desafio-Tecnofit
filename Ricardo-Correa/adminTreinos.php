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

            <div id="divTreino" name="divTreino">             
                <?php $results = mysqli_query($connect, "SELECT nome,id_treino FROM tb_treino order by nome asc"); ?>
                <table>
                    <caption><h3>Treinos</h3></caption>
                    
                    <thead>
                        <tr>
                            <td class="esquerda" colspan="2">
                            <a href="frmTreinoIncluir.php"><img class="iconMini" src="img/add.png" />Inserir novo treino</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Nome</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    
                    <?php 
                    if(! mysqli_num_rows($results)){ ?>
                        <tr><td colspan="2"><i>Não há Treinos cadastrados</td></tr>
                    <?php 
                    } 
                    else{                        
                        while ($row = mysqli_fetch_array($results)) { ?>
                            <tr>
                                <td><?=$row['nome']; ?></td>
                                <td>
                                    <a href="#" onclick="EnviaPost(0,'relTreino',<?=$row['id_treino']; ?>);" ><img class="iconMini" src="img/v.png" /></a>
                                    <a href="#" onclick="EnviaPost(0,'frmAlteraTreino',<?=$row['id_treino']; ?>);" ><img class="iconMini" src="img/e.png" /></a>
                                    <a href="#" onclick="$.fn.ExcluirTreino(<?=$row['id_treino']; ?>);"><img class="iconMini" src="img/d.png" /></a>
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
    $.fn.ExcluirTreino = function(id){
        if(confirm("Confirma essa ação?")){
            $.get("ajax/ajaxExcluiTreino.php", "id=" + id, function( data ) {
                location.reload();
            });
        }
    };
});
</script>
