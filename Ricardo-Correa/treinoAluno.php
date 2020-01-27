<?php
session_start();
include_once("incSegurancaAluno.php");
include_once("incHeader.php");
$id = $_POST['id'];
?>

<form method="post" id="frmAdmin" name="frmAdmin">
    <input type="hidden" id="id" name="id" value="<?=$id?>" />
	<div class="container super">
        <div class="box grande">
        <?php include_once("incPerfil.php"); ?>

            <h2>Treino em Andamento</h2>
            <a href="portalAluno.php"><img class="iconMedio" src="img/voltar.png" /></a>


            <div id="divAluno" name="divAluno">             
                <?php 

                $idTreino = "";
                $results = mysqli_query($connect, "SELECT A.nome, A.email, A.id_treino, T.nome as Treino, T.series from tb_aluno A left join tb_treino T on T.id_treino = A.id_treino where A.id_aluno = $id");
                while ($row = mysqli_fetch_array($results)){
                    $idTreino = $row['id_treino'];
                    ?>
                    <p>
                        <h2 class="azul"><?=$row['nome']?></h2>
                    </p>
                    <strong>Treino Atual: </strong>
                    <?php
                    if(is_null($row['Treino'])){ echo "<i>Nenhum treino cadastrado</i>";} else{ echo $row['Treino'] . " / <b>Séries:</b> " . $row['series'];};
                }

                 ?>
                    
                    <div id="divExercicio" name="divExercicio">                          
                        <?php 
                        $rowTE = "";
                        $resultsTE = mysqli_query($connect, "SELECT 
                                                                    E.id_exercicio, 
                                                                    E.nome,
                                                                    T.series, 
                                                                    J.NumRepeticoes
                                                                FROM tb_exercicio E  
                                                                inner join tb_treino_exercicio J on J.id_exercicio = E.id_exercicio
                                                                inner join tb_treino T on T.id_treino = J.id_treino
                                                                where J.id_treino = $idTreino;"
                                                                ); ?>
                        <table>
                            <caption><h3>Roteiro de exercícios do treino atual</h3></caption>

                            <thead>
                                <tr><td colspan="4" class="azul">Assinale as realizações dos mesmos após ou durante seu treino.</td></tr>
                                <tr>
                                    <th>Nome</th>
                                    <th>Séries</th>
                                    <th>Repetições</th>
                                    <th>Realizado</h>
                                </tr>
                            </thead>
                            
                            <?php 
                            if(! mysqli_num_rows($resultsTE)){ ?>
                                <tr><td colspan="4"><i>Favor solicitar o cadastro de seu novo treino</td></tr>
                            <?php 
                            } 
                            else{  
                                $c = 1;                      
                                while ($rowTE = mysqli_fetch_array($resultsTE)) { ?>
                                    <tr>
                                        <td><?=$rowTE['nome']; ?></td>
                                        <td><?=$rowTE['series']; ?></td>
                                        <td><?=$rowTE['NumRepeticoes']; ?></td>  
                                        <td>
                                            <input type="hidden" nome="idExercicio<?=$c?>" id="idExercicio<?=$c?>" value="<?=$rowTE['id_exercicio']?>" />
                                            <input type="checkbox" name="chkTreino<?=$c?>" id="chkTreino<?=$c?>" />                                            
                                        </td>  
                                    </tr>
                            <?php
                                $c += 1; 
                                }
                            } 
                            ?>
                            <tr>
                                <td colspan="3" style="text-align: center;">
                                <button type="button" id="btnGravarHistorico">Gravar histórico</button>
                                <button type="button" id="btnCancelarTreino" class="bgRed" onclick="window.location.href='portalAluno.php';">Cancelar</button>
                                </td>
                            </tr>
                        </table>
                    </div>          
                
            </div>
			<a href="portalAluno.php"><img class="iconMedio" src="img/voltar.png" /></a>
        </div>
    </div>
</form>
<?php include_once("incFooter.php"); ?>

<script>
$("#btnGravarHistorico").click(function(){
    var strE = "";
    var strR = "";
    for(c = 1; c <= <?=$c-1?>; c++){
        strE += $("#idExercicio" + c).val() + ",";
        strR += $("#chkTreino" + c).is(":checked") + ",";
    }
    //window.location.href = "ajax/ajaxNovoHistTreino.php?idAluno=" + $("#id").val() + "&idTreino=<?=$idTreino?>&idExercicio=" + strE + "&Realizou=" + strR;
    $.get("ajax/ajaxNovoHistTreino.php", "idAluno=" + $("#id").val() + "&idTreino=<?=$idTreino?>&idExercicio=" + strE + "&Realizou=" + strR, function( data ) {
        window.location.href = "portalAluno.php";
    });
});
</script>
