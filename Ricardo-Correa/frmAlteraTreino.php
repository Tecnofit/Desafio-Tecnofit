<?php
session_start();
include_once("incSeguranca.php");
include_once("incHeader.php");
$nomex = "";

echo "";
?>

<form method="post" id="frmAdmin" name="frmAdmin">
	<div class="container super">
        <div class="box grande">

<?php include_once("incPerfil.php"); ?>

            <h2>Módulo de Administração</h2>
            <a href="adminTreinos.php"><img class="iconMedio" src="img/voltar.png" /></a>

            <div id="divTreino" name="divTreino">
            <?php 
            $row = "";
            $nomex = "";
            $id = "";
            if(isset($_POST['id'])){
            $id = $_POST['id'];    
            }     
            //echo "SELECT id_treino, nome, series FROM tb_treino where id_treino=$id ";       
            $results = mysqli_query($connect, "SELECT id_treino, nome, series FROM tb_treino where id_treino=$id ");
            while($row = mysqli_fetch_array($results)){
                $nomex = $row['nome'];
                $series = $row['series'];
                if(! is_null($row['id_treino'])){ $idTreino = 0;} else{$idTreino = $row['id_treino'];}
            }
            $resultsT = mysqli_query($connect, "SELECT id_exercicio, nome 
                                                FROM tb_exercicio 
                                                where ativo=1 and id_exercicio not in (
                                                    select id_exercicio
                                                    from tb_treino_exercicio
                                                    where id_treino = $id
                                                ) ");
            ?>
                <p><h3>Editando Treino</h3></p>
                <p>                                        
                    <input type="text" maxlength="100" id="txtTreinoNome" name="txtTreinoNome" value="<?=$nomex?>" placeholder="Digite o nome do novo treino" />
                    <input type="number" maxlength="4" id="txtSeries" name="txtSeries" value="<?=$series?>" placeholder="Series" />
                    <input type="hidden" name="id" id="id" value="<?=$id?>" />
                    <button type="button" id="GravarTreino">Gravar</button>
                    <!--<button type="button" id="btnCancelarTreino" class="bgRed" onclick="window.location.href='adminTreinos.php';">Cancelar</button>-->

                    <div id="divExercicio" name="divExercicio">  
                          
                        <?php $results = mysqli_query($connect, "SELECT 
                                                                    E.id_exercicio, 
                                                                    E.nome, 
                                                                    J.NumRepeticoes
                                                                FROM tb_exercicio E  
                                                                inner join tb_treino_exercicio J
                                                                on J.id_exercicio = E.id_exercicio
                                                                where J.id_treino = $id;"
                                                                ); ?>
                        <table>
                            <caption><h3>Exercícios deste Treino</h3></caption>

                            <thead>
                                <tr>
                                <td colspan="3">
                                    <select id="txtExercicio" name="txtExercicio" style="width:50% !important;">
                                        <option value="0">Selecione um exercício</option>
                                        <?php
                                            while($rowE = mysqli_fetch_array($resultsT)){?>
                                                <option value="<?=$rowE['id_exercicio']?>" ><?=$rowE['nome']?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                    <input type="number" maxlength="4" id="txtNumRepeticoes" name="txtNumRepeticoes" placeholder="Repetições" />
                                    <button type="button" id="AddExeTreino" name="AddExeTreino">+</button>
                                </td>
                                </tr>                           
                                <tr>
                                    <th>Nome</th>
                                    <th>Repetições</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            
                            <?php 
                            if(! mysqli_num_rows($results)){ ?>
                                <tr><td colspan="3"><i>Não há exercícios cadastrados neste treino</td></tr>
                            <?php 
                            } 
                            else{                        
                                while ($row = mysqli_fetch_array($results)) { ?>
                                    <tr>
                                        <td><?=$row['nome']; ?></td>
                                        <td><?=$row['NumRepeticoes']; ?></td>    
                                        <td>
                                            <a href="#" onclick="$.fn.ExcluirExeTreino(<?=$id ?>,<?=$row['id_exercicio']; ?>);"><img class="iconMini" src="img/d.png" /></a>
                                        </td>
                                    </tr>
                            <?php 
                                }
                            } 
                            ?>
                        </table>
                    </div>

                </p>
            </div>
			<a href="adminTreinos.php"><img class="iconMedio" src="img/voltar.png" /></a>
        </div>
    </div>
</form>
<?php include_once("incFooter.php"); ?>

<script>
$(document).ready(function(){
    $("#GravarTreino").click(function(){
        if($("#txtTreinoNome").val() == "" || $("#txtSeries").val() == ""){
            alert("Ação negada.\nÉ necessário preencher um nome e número de series.");
        }
        else{
            $.get("ajax/ajaxAlteraTreino.php", "id=" + $("#id").val() + "&nome=" + $("#txtTreinoNome").val() + "&series=" + $("#txtSeries").val(), function( data ) {
                 window.location.href = "adminTreinos.php";
            });
        }
    });

    $("#AddExeTreino").click(function(){
        if($("#txtExercicio").val() == "0" || $("#txtNumRepeticoes").val() == ""){
            alert("Ação negada.\nÉ necessário escolher um exercício e indicar o número de repetições.");
        }
        else{
            $.get("ajax/ajaxAddExeTreino.php", "id=" + $("#id").val() + "&idExercicio=" + $("#txtExercicio").val() + "&NumR=" + $("#txtNumRepeticoes").val(), function( data ) {
                EnviaPost(0, "frmAlteraTreino", $("#id").val());
            });
        }
    });

    $.fn.ExcluirExeTreino = function(idTre, idExe){
        if(confirm("Confirma esta ação?")){
            $.get("ajax/ajaxExcluiExeTreino.php", "id=" + idTre + "&idExercicio=" + idExe, function( data ) {
                EnviaPost(0, "frmAlteraTreino", idTre);
            });
        }      
    }
});
</script>