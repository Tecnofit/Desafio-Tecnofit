<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Listagem de Treino</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../Assets/css/main.css">
  <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
</head>
<body>
  <?php 

  require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Treino.php");

  session_start();
  include $_SESSION["admin"] == 1 ? "../menu_admin.html" : "../menu.html";

  if(isset($_SESSION["msg"])){
    $msg = $_SESSION["msg"];
    $html = "<div class='alert alert-info text-center'><strong>$msg</strong></div>";
    echo $html;
    unset($_SESSION["msg"]);
  }
  
  ?>
  <div class="container">
    <div class="row">
      <div class="col-12">
       <a href="treino_cadastro.php" type="button" class="btn btn-primary">Cadastrar</a>
       <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php 

          $treinos = [];
          $treinos = Treino::listar();

          foreach($treinos as $treino){
            $html = "
            <tr>
            <th scope='row'>" . $treino->getCodigo() . "</th>
            <td>" . $treino->getNome() . "</td>
            <td>
            <a href='../Controllers/TreinoControl.php?action=buscar&codigo=" . $treino->getCodigo() . "' type='button' class='btn btn-success'><i class='far fa-edit'></i></a>
            </td>
            </tr>";
            echo $html;
          }

          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/f696ad2a76.js" crossorigin="anonymous"></script>
</body>
</html>
