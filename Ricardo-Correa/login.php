<?php
  $login = mb_strtolower($_POST['txtLogin']);
  $senha = $_POST['txtPwd'];

  require_once("db_connect.php");
  session_start();

  $query = "select id_admin as id, adm.login, adm.login as nome, 'ADMINISTRADOR' as TipoUsuario
             from tb_admin adm where lower(adm.login)='$login' and adm.senha='$senha' 
             union select alu.id_aluno as id, alu.email as login, alu.nome, 'ALUNO' as TipoUsuario
             from tb_aluno alu where lower(alu.email)='$login' and alu.senha='$senha' 
             ";
  $resultado = mysqli_query($connect, $query);
  $usuarios = mysqli_fetch_array($resultado);

  if($usuarios){
    $_SESSION["id"] = $usuarios["id"];
    $_SESSION["login"] = $usuarios["login"];
    $_SESSION["nome"] = $usuarios["nome"];
    $_SESSION["TipoUsuario"] = $usuarios["TipoUsuario"];

    if ($_SESSION["TipoUsuario"] == "ADMINISTRADOR"){
      header("Location: portalAdmin.php"); 
    }
    else{
      header("Location: portalAluno.php"); 
    }
  }
  else{
    $_SESSION['msg'] = "Usuário ou senha inválido!";
    header("Location: index.php"); 
  }



 
?>
