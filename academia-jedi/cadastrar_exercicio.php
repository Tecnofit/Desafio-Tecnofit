<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academia Jedi - Cadastro de exercício</title>
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

<section class="hero">
            <div class="hero-body">
    <div class="container">
      <h1 class="title">
        Exercícios
      </h1>

      <div class="container has-text-centered">
      	<h1 class="subtitle">
      		<b>Cadastrar Exercício</b>
      	</h1>
        </div>
        <br></br>
            
        <div class="field">
          <form action="cadastro_exercicio.php" method="POST">
  <label class="label">Nome</label>
  <div class="control">
    <input name="nome_exercicio" class="input is-rounded" type="text" placeholder="Digite o nome do exercício">
  </div>
</div>

<div class="field">
  <label class="label">Série</label>
  <div class="control">
    <input name="serie_exercicio" class="input is-rounded" type="text" placeholder="Digite a quantidade de séries do exercício">
  </div>
</div>

<div class="field">
  <label class="label">Repetições</label>
  <div class="control">
    <input name="repeticoes_exercicio" class="input is-rounded" type="text" placeholder="Digite a quantidade de repetições do exercício">
  </div>
</div>

<div class="field">
  <label class="label">Descrição</label>
  <div class="control">
    <input name="descricao_exercicio" class="input is-rounded" type="text" placeholder="Digite a descrição do exercício (opcional)">
  </div>
</div>

<br></br>

<div class="field is-grouped">
  <p class="control">
    <button type="submit" class="button is-block is-link is-normal">Cadastrar</button>
  </p>
  <p class="control">
    <button type="reset" class="button is-block is-link is-normal">Limpar</button>
  </p>
  <p class="control">
    <a class="button is-small  is-link is-normal" href = "exercicios.php">Voltar para a lista</a>
  </p>
</div>

</form>
    </div>
  </div>



  </section>
		</body>
		</html>