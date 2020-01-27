<?php
 require_once("../db_connect.php");
 session_start();
 $id = "";
 $series = "0";
 if(isset($_GET['series'])){ $series = $_GET['series'];}
 $nome = "";
 if(isset($_GET['nome'])){ $nome = str_replace("'", "", $_GET['nome']); }
$query = "insert into tb_treino(nome,series) values('$nome','$series');";
$results = mysqli_query($connect, $query);
$query = "SELECT LAST_INSERT_ID() as id;";
$results = mysqli_query($connect, $query);
while ($row = mysqli_fetch_array($results)) {
    $id = $row['id'];
}
$_SESSION['msg'] = "Treino '$nome' incluído com sucesso.";

var_dump($id);

?>