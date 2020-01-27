 <?php
 require_once("../db_connect.php");
 session_start();

 $id = $_GET['id'];

 $query = "delete from tb_aluno where id_aluno=$id";
 $resultado = mysqli_query($connect, $query);

 $query = "delete from tb_exercicios_executados where id_aluno=$id";
 $resultado = mysqli_query($connect, $query);

 $_SESSION['msg'] = "Usuário excluído com sucesso";

var_dump($_GET);

?>