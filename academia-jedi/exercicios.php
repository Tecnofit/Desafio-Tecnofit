<?php
session_start();
include("conexao_aluno.php");

$consulta = "SELECT idexercicio, nome_exercicio, descricao_exercicio, serie_exercicio, repeticoes_exercicio FROM exercicio";
$con = $conexao ->query($consulta) or die($conexao->error);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academia Jedi - Lista de Exercícios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.0/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script defer src="js/confirm.js"></script>
    <script defer src="js/alteracao.js"></script>
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
        Exercícios
      </h1>

      <div class="container has-text-centered">
        <h1 class="subtitle">
          <b>Lista de Exercícios</b>
        </h1>
      </div>

      <br></br>

      <?php
                    if(isset($_SESSION['status_cadastro'])):
                    ?>
                    <div class="notification is-success has-text-centered">
                      <p>Cadastro efetuado com sucesso!</p>
                    </div>                   
                    <?php
                    endif;
                    unset($_SESSION['status_cadastro']);
                    ?>

      <?php
                    if(isset($_SESSION['status_alteracao'])):
                    ?>
                    <div class="notification is-success has-text-centered">
                      <p>Alteração efetuada com sucesso!</p>
                    </div>                   
                    <?php
                    endif;
                    unset($_SESSION['status_alteracao']);
                    ?>

      <?php
                    if(isset($_SESSION['status_exclusao'])):
                    ?>
                    <div class="notification is-danger has-text-centered">
                      <p>Exclusão do exercício efetuada com sucesso!</p>
                    </div>                   
                    <?php
                    endif;
                    unset($_SESSION['status_exclusao']);
                    ?>

     <a class="button is-small is-link" href="cadastrar_exercicio.php">Cadastrar exercício</a>
    </br></br>
        <table class="table">
          <thead>
          <tr>
        <th>Exercício</th>
      <th>Série</th>
      <th>Repetições</th>
      <th>Descrição</th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
    <tbody>
      <?php while($dado = $con->fetch_array()){ ?>
            <tr>
            <td><?php echo $dado["nome_exercicio"]; ?></td>
            <td><?php echo $dado["serie_exercicio"]; ?></td>
            <td><?php echo $dado["repeticoes_exercicio"]; ?></td>
            <td><?php echo $dado["descricao_exercicio"]; ?></td>
            <td><?php echo "<a class='button is-small is-info' href='exercicio.php?idexercicio=" . $dado["idexercicio"] . "'>Visualizar</a>"; ?></td>
            <td><?php echo "<a class='button is-small is-info' href='alterar_exercicio.php?idexercicio=" . $dado["idexercicio"] . "'>Editar</a>"; ?></td>
            <td><?php echo "<a class='button is-small is-danger' href='excluir_exercicio.php?idexercicio=" . $dado["idexercicio"] . "'>Excluir</a>"; ?></td>

            </tr>
          <?php } ?>
          </tbody>
  </thead>
</table>

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