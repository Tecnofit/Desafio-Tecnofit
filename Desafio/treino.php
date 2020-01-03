<?php
include __DIR__."/db.php";
include __DIR__."/functions.php";
$db = conn();

session_start();
logado();
if (isset($_POST['concluirExercicio']) and isset($_POST['id'])) {
  $sql = "UPDATE `treino` SET `statusExercicio`='Concluído';";

  $result = $db->query($sql);
  //cria uma sessão para apresentar uma div de cadastro realizado
  if ($result == true) {}
}elseif (isset($_POST['pularExercicio']) and isset($_POST['id'])) {
  $sql = "UPDATE `treino` SET `statusExercicio`='Não Realizado';";

  $result = $db->query($sql);
  //cria uma sessão para apresentar uma div de cadastro realizado
  if ($result == true) {}
}elseif (isset($_POST['sair'])){
  session_destroy();
  echo "<script>location.href = 'terminal.php';</script>";
}

?>

<html lang="pt-b">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="desafio.css">
      <title>Treino</title>
  </head>
  <body>

    <?php
      $db = conn();
      buscaTreinoTerminal();
    ?>
    <form action="treino.php" method="post">
      <input class="btn btn-danger" type="submit" name="sair" value="Sair">
    </form>
    <?php include("bootstrap.php"); ?>
  </body>
</html>
