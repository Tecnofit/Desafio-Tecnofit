<?php
session_start();
include("conexao_aluno.php");

$consulta = "SELECT idaluno, nomealuno, email, endereco, altura, peso FROM aluno";
$con = $conexao ->query($consulta) or die($conexao->error);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academia Jedi - Aluno</title>
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
        Alunos
      </h1>

      <div class="container has-text-centered">
      	<h1 class="subtitle">
      		<b>Perfil do Aluno</b>
      	</h1>
      <br></br>  
      <?php 
      if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset ($_SESSION['msg']);
      }
      $result_aluno = "SELECT * FROM aluno";
      $resultado_aluno = mysqli_query($conexao, $result_aluno);
      while($row_aluno = mysqli_fetch_assoc($resultado_aluno)){
        echo "<b>" . strtoupper($row_aluno['idaluno'] . " - " . $row_aluno['nomealuno']) . "<br></b>";
        echo "<br><b>E-mail:</b> " . $row_aluno['email'] . "<br>";
        echo "<br><b> Endereco:</b> " . $row_aluno['endereco'] . "<br>";
        echo "<br><b> Altura:</b> " . $row_aluno['altura'] . " cm<br>";        
        echo "<br><b> Peso:</b> " . $row_aluno['peso'] . " kg<br>";
        echo "<br><b> Treino ativo:</b><br>"; # Incluir o treino ativo do aluno

      }

      ?>   
      <br><br><br>
      <div class="field is-grouped">
      <p class="control">
    <a class="button is-normal  is-link is-primary" href = "treinos.php">Cadastrar treino</a>
  </p> 
      <p class="control">
    <a class="button is-normal  is-link is-primary" href = "alunos.php">Voltar para a lista</a>
  </p> 
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