<?php
session_start();
include __DIR__."/db.php";
include __DIR__."/functions.php";
$db = conn();
logado();
if (isset($_POST['cpf'])) {

  login($_POST);

}elseif (isset($_POST['senha']) and isset($_POST['treinador'])) {
  if ($_POST['senha'] == '123') {
    echo "<script>location.href = 'alunos.php';</script>";
  }
}
?>

<html lang="pt-br">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="desafio.css">

<title>Terminal</title>
</head>
<body>

    <div>
      <?php
      if (isset($_SESSION['temp'])) {
        if($_SESSION['temp'] == 'desconhecido') {
          echo "<div class='alert alert-danger col-md-6' role='alert' id='temp'> CPF não Encontrado! Procure a recepção </div>";
          unset($_SESSION['temp']);
        }
      }
      ?>
    </div>

    <div class="login-form col-sm-6" >
      <form method="post" action="terminal.php">
          <h2 class="text-center">Entrar</h2>
          <div class="form-group">
              <input type="text" class="form-control" name="cpf" id="cpf" placeholder="CPF" required>
          </div>
          <div class="form-group">
              <input type="submit" class="btn btn-primary btn-block" value="Acessar" id="acessar" name="acessar"></input>
          </div>
      </form>
      <p class="text-center"><a href="#"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Acessar Como Administrador</button></a></p>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Acessar como Administrador</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="terminal.php" method="post" id="admin">
            <label for="">Senha</label>
            <input type="password" name="senha" >
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <input class="btn btn-success" type="submit" name="treinador" value="Acessar" form="admin" >
          </div>
        </div>
      </div>
    </div>

    <?php include("bootstrap.php"); ?>
</body>

</html>
