<?php
    require_once("../db_connect.php");
    session_start();

    $idAluno = $_GET['idAluno'];
    $idTreino = $_GET['idTreino'];
    $idExercicio = explode(',', $_GET['idExercicio'], -1);
    $Realizou = explode(',', $_GET['Realizou'], -1);

    $count = count($idExercicio);
    for ($i = 0; $i < $count; $i++) {
    $query = "insert into tb_exercicios_executados(dt_DataHora,id_Aluno,id_Exercicio,id_Treino,Realizou)
                values(now(),$idAluno,$idExercicio[$i],$idTreino,$Realizou[$i]);";
    $results = mysqli_query($connect, $query);
    }

    $_SESSION['msg'] = "Treino gravado com sucesso.";

?>