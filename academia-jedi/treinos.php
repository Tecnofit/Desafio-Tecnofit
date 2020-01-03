<?php
session_start();
include('verifica_login.php');
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academia Jedi - Treinos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  </head>
  <body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="painel.php">
      <img src="https://i.ibb.co/DD5WZ8w/star-wars-jedi-knight-jedi-academy-the-new-jedi-order-logo-war.png">
    </a>

    </div>

  <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="alunos.php">
        Alunos
      </a>

      <a class="navbar-item" href="treinos.php">
        Treinos
      </a>

        <a class="navbar-item" href="exercicios.php">
          Exercícios
        </a>
      </div>
    </div>

      

    <div class="navbar-end">
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary" href="index_aluno.php">
            <strong>Área do Aluno</strong>
          </a>
          <a class="button is-info" href="logout.php">
            <strong>Sair</strong>
          </a>
        </div>
      </div>
    </div>
  </div>
</nav>

<!--Título-->
<section class="hero">
            <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Treinos
      </h1>
      <div class="container has-text-centered">
        <h1 class="subtitle">
          <b>Lista de Treinos</b>
        </h1>
      </div>
    </div>
  </div>
  </section>
</body>

<footer class="footer">
  <div class="content has-text-centered">
    <p>
      <h5>Que a força esteja com você!</h5>
    </p>
  </div>
</footer>
    </html>