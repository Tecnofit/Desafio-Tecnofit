<?php
 require_once("../db_connect.php");
 session_start();

 $id = $_GET['id'];

$query = "Select id_treino 
            from tb_exercicios_executados J 
            where id_treino=$id 
            ";    
$resultado = mysqli_query($connect, $query);
if(! mysqli_num_rows($results)){
    $query = "delete from tb_treino where id_treino=$id";
    $resultado = mysqli_query($connect, $query);
    $_SESSION['msg'] = "Treino excluído com sucesso"; 
}
else{
    $query = "update tb_treino set ativo=0 where id_treino=$id";
    $resultado = mysqli_query($connect, $query);
    $_SESSION['msg'] = "Treino desativado com sucesso. \\nO mesmo não pode ser excluído por uma questão de \\nintegridade de dados, pois o mesmo consta \\nno histórico de um ou mais alunos."; 
}   

var_dump($_GET);

?>