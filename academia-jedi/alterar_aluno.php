<?php
session_start();
include_once("conexao_aluno.php");

$idaluno = filter_input(INPUT_GET, 'idaluno', FILTER_SANITIZE_NUMBER_INT);
$result_aluno = "SELECT * FROM aluno WHERE idaluno = '$idaluno'";
$resultado_aluno = mysqli_query($conexao,  $result_aluno);
$row_aluno = mysqli_fetch_assoc($resultado_aluno);

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academia Jedi - Alterar aluno</title>
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
  </nav>

<section class="hero">
            <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Alunos
      </h1>

      <div class="container has-text-centered">
      	<h1 class="subtitle">
      		<b>Alterar Aluno</b>
      	</h1>
        </div>
        <br></br>
         
        <div class="field"> 
          <form action="alteracao_aluno.php" method="POST">
            <input type="hidden" name="idaluno" value="<?php echo $row_aluno['idaluno']; ?>">

  <label class="label">Nome completo</label>
  <div class="control">
    <input name="nomealuno" class="input is-rounded" type="text" placeholder="Digite o nome completo" value="<?php echo $row_aluno['nomealuno']; ?>">
  </div>
</div>

<div class="field">
  <label class="label">E-mail</label>
  <div class="control">
    <input name="email" class="input is-rounded" type="text" placeholder="Digite o endereço de e-mail" value="<?php echo $row_aluno['email']; ?>">
  </div>
</div>

<div class="field">
  <label class="label">Endereço</label>
  <div class="control">
    <input name="endereco" class="input is-rounded" type="text" placeholder="Digite o endereço completo" value="<?php echo $row_aluno['endereco']; ?>">
  </div>
</div>

<div class="field">
  <label class="label">Altura</label>
  <div class="control">
    <input name="altura" class="input is-rounded" type="text" placeholder="Digite a altura" value="<?php echo $row_aluno['altura']; ?>">
  </div>
</div>

<div class="field">
  <label class="label">Peso</label>
  <div class="control">
    <input name="peso" class="input is-rounded" type="text" placeholder="Digite o peso" value="<?php echo $row_aluno['peso']; ?>">
  </div>
</div>
<br></br>

<div class="field is-grouped">
  <p class="control">
    <button type="submit" class="button is-block is-link is-normal">Salvar</button>
  </p>
  <p class="control">
    <a class="button is-small  is-link is-normal" href = "alunos.php">Voltar para a lista</a>
  </p>
</div>

</form>
    </div>
  </div>



  </section>
		</body>
		</html>