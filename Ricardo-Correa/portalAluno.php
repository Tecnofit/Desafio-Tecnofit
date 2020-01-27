<?php
session_start();
include_once("incSegurancaAluno.php");
include_once("incHeader.php");
?>

<form method="post" id="frmAdmin" name="frmAdmin">
    
	<div class="container super">
        <div class="box grande">
        <?php include_once("incPerfil.php"); ?>

            <h2>Módulo do Aluno</h2>

            <div id="divAluno" name="divAdmin">             
                <?php 
                $id = $_SESSION['id'];
                $idTreino = "";
                $results = mysqli_query($connect, "SELECT A.nome, A.email, A.id_treino, T.nome as Treino, T.series from tb_aluno A left join tb_treino T on T.id_treino = A.id_treino where A.id_aluno = $id");
                while ($row = mysqli_fetch_array($results)){
                    $idTreino = $row['id_treino'];
                    ?>
                    <p>
                        <h2 class="azul"><?=$row['nome']?></h2>
                        <h4><a href="mailto:<?=$row['email']?>"><?=$row['email']?></a></h4>
                    </p>
                    <strong>Treino Atual: </strong>
                    <?php
                    if(is_null($row['Treino'])){ echo "<i>Nenhum treino cadastrado</i>";} else{ echo $row['Treino']  . " / <b>Séries:</b> " . $row['series'];};
                }

                $resultsT = mysqli_query($connect, "SELECT 
                                                        A.nome, 
                                                        J.dt_DataHora, 
                                                        T.nome as Treino,
                                                        E.nome as Exercicio,
                                                        T.series,
                                                        X.NUMrepeticoes,
                                                        if(J.realizou=1,'Sim','Não') as realizou
                                                        FROM tb_exercicios_executados J 
                                                        INNER JOIN tb_aluno A on J.id_aluno = A.id_aluno
                                                        INNER JOIN tb_treino T on J.id_treino = T.id_treino
                                                        INNER JOIN tb_exercicio E on J.id_exercicio = E.ID_exercicio
                                                        INNER JOIN tb_treino_exercicio X on J.id_treino = X.id_treino and J.id_exercicio = X.id_exercicio
                                                        where A.id_aluno = $id order by J.dt_DataHora desc"); ?>
                    
                    <div id="divExercicio" name="divExercicio">
                        <br /> 
                        <p>
                            <input type="hidden" id="id" name="id" value="<?=$id?>" />
                            <button type="button" class="verde" id="IniciarTreino" name="IniciarTreino">Iniciar Treino</button> 
                        </p>                        
                        <?php 
                        $rowTE = "";
                        $resultsTE = mysqli_query($connect, "SELECT 
                                                                    E.id_exercicio, 
                                                                    E.nome, 
                                                                    J.NumRepeticoes
                                                                FROM tb_exercicio E  
                                                                inner join tb_treino_exercicio J
                                                                on J.id_exercicio = E.id_exercicio
                                                                where J.id_treino = $idTreino;"
                                                                ); ?>
                        <table>
                            <caption><h3>Exercícios deste Treino</h3></caption>

                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Repetições</th>
                                </tr>
                            </thead>
                            
                            <?php 
                            if(! mysqli_num_rows($resultsTE)){ ?>
                                <tr><td colspan="3"><i>Não há exercícios cadastrados neste treino</td></tr>
                            <?php 
                            } 
                            else{                        
                                while ($rowTE = mysqli_fetch_array($resultsTE)) { ?>
                                    <tr>
                                        <td><?=$rowTE['nome']; ?></td>
                                        <td><?=$rowTE['NumRepeticoes']; ?></td>    
                                    </tr>
                            <?php 
                                }
                            } 
                            ?>
                        </table>
                    </div>
          
                <table>
                    <caption><h3>Histórico de Exercícios</h3></caption>
                    <thead>
                        <tr>
                            <!--<th>Nome</th>-->
                            <th>Data/Hora</th>
                            <th>Treino</th>
                            <th>Exercício</th>
                            <th>Series</th>
                            <th>Repetições</th>
                            <th>Realizou</th>
                        </tr>
                    </thead>
                    
                    <?php 
                    if(! mysqli_num_rows($resultsT)){ ?>
                        <tr><td colspan="6"><i>Não há histórico registrado</td></tr>
                    <?php 
                    } 
                    else{                        
                        while ($row = mysqli_fetch_array($resultsT)) { ?>
                            <tr>
                                <!--<td><?=$row['nome']; ?></td>-->
                                <td><?=$row['dt_DataHora']; ?></td>
                                <td><?=$row['Treino']; ?></td>
                                <td><?=$row['Exercicio']; ?></td>
                                <td><?=$row['series']; ?></td>
                                <td><?=$row['NUMrepeticoes']; ?></td>
                                <td><?=$row['realizou']; ?></td>
                            </tr>
                    <?php 
                        }
                    } 
                    ?>
                </table>
            </div>
        </div>
    </div>
</form>
<?php include_once("incFooter.php"); ?>

<script>
    $(document).ready(function(){
        $("#IniciarTreino").click(function(){
            EnviaPost(0, "treinoAluno", $("#id").val());
        });
    });
</script>
