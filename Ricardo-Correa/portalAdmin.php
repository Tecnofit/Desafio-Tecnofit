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
            <div >
                <div style="display: inline-block;"><a href="adminAlunos.php"><img src="img/aluno.png" class="iconGrande"><br>Alunos</a></div>
                <div style="display: inline-block;"><a href="adminExercicios.php" ><img src="img/exercicio.png" class="iconGrande"><br>Exercícios</a></div>
                <div style="display: inline-block;"><a href="adminTreinos.php"><img src="img/treino.png" class="iconGrande"><br>Treinos</a></div>
            </div>
        </div>
    </div>
</form>


<?php include_once("incFooter.php"); ?>