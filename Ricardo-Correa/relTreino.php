<?php
session_start();
include_once("incSeguranca.php");
include_once("incHeader.php");
$nomex = "";
$series = "";
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
            $id = $_POST['id'];
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
                <p>
                    <h3>Visualização do Treino:</h3>
                    <h2 class="azul"><?=$nomex?></h2>
                    <h3><strong>Total de séries:</strong> <?=$series?></h3>
                </p>
                <p>                                        
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
                                    <th>Nome</th>
                                    <th>Repetições</th>
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
