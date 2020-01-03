<?php
session_start();
include('verifica_login.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academia Jedi - Área do aluno</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item">
      <img src="https://i.ibb.co/DD5WZ8w/star-wars-jedi-knight-jedi-academy-the-new-jedi-order-logo-war.png">
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
          <div class="navbar-item">
        <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-info" href="index_aluno.php">
            <strong>Retornar</strong>
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>
    <!--Título-->
<section class="hero">
            <div class="hero-body">
    <!--<div class="container">-->
      <h3 class="subtitle">
        Olá, Padawan <?php echo $_SESSION['nomealuno'];
        ?>! Selecione seu treino:
      </h3>
    </div>
  </div>
  </section>

  
    </body>
    </html>