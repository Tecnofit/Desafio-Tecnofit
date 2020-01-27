<?php
 require_once("../db_connect.php");
 session_start();

$nome = str_replace("'", "", $_GET['nome']);

$email = "";
if(isset($_GET['email'])){
$email = str_replace("'", "", $_GET['email']);
}

$query = "insert into tb_aluno(nome, email, senha, primeiro_acesso) values('$nome', '$email', '1234', '1');";
$results = mysqli_query($connect, $query);
$query = "SELECT LAST_INSERT_ID() as id;";
$results = mysqli_query($connect, $query);
while ($row = mysqli_fetch_array($results)) {
    $id = $row['id'];
}
$_SESSION['msg'] = "Usuário '$nome' incluído com sucesso. \\nSenha padrão: 1234";

var_dump($id);

?>