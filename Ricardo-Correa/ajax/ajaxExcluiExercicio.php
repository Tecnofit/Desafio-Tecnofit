<?php
 require_once("../db_connect.php");
 session_start();

 $id = "0";
 if(isset($_GET['id'])){
     $id = $_GET['id'];
 }

 //O exercício só poderá ser deletado se o mesmo não estiver presente em um treino ativo;
$query = "Select A.nome from tb_aluno A
                inner join tb_treino T on T.id_treino = A.id_treino
                inner join tb_treino_exercicio J on J.id_treino = T.id_treino
                where J.id_exercicio=$id";
$results = mysqli_query($connect, $query);
if(! mysqli_num_rows($results)){
    $query = "Select * 
                from tb_exercicios_executados J 
                where id_exercicio=$id ";    
    $results = mysqli_query($connect, $query);
    if(! mysqli_num_rows($results)){
        $query = "delete from tb_exercicio where id_exercicio=$id";
        $results = mysqli_query($connect, $query);
        $query = "delete from tb_treino_exercicio where id_exercicio=$id";
        $results = mysqli_query($connect, $query);
        $_SESSION['msg'] = "Exercício excluído com sucesso"; 
    }
    else{
        $query = "update tb_exercicio set ativo=0 where id_exercicio=$id";
        $results = mysqli_query($connect, $query);
        $_SESSION['msg'] = "Exercício desativado com sucesso. \\nO mesmo não pode ser excluído por uma questão de \\nintegridade de dados, pois o mesmo consta \\nno histórico de um ou mais alunos."; 
    }   
}
else{
    $_SESSION['msg'] = "Permissão negada!\\nEsse exercício faz parte de um ou mais treinos ativos";       
}

var_dump($_GET);

?>