<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../Assets/css/main.css">
  <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
  <title>Painel Administrador</title>
</head>
<body>
  <?php

  session_start();
  include $_SESSION["admin"] == 1 ? "../menu_admin.html" : "../menu.html";
  $nomeUsuario = $_SESSION["nome"];
  $html = "<div class='container'><h3>Seja Bem-Vindo $nomeUsuario</h3></div>";
  echo $html;
  
  ?>
</body>
</html>
