<?php
 require_once("../db_connect.php");
 session_start();
 $id = "";
$nome = str_replace("'", "", $_GET['nome']);
$query = "insert into tb_exercicio(nome, ativo) values('$nome', '1');";
$results = mysqli_query($connect, $query);
$query = "SELECT LAST_INSERT_ID() as id;";
$results = mysqli_query($connect, $query);
while ($row = mysqli_fetch_array($results)) {
    $id = $row['id'];
}
$_SESSION['msg'] = "Exercício '$nome' incluído com sucesso.";

var_dump($id);

?>