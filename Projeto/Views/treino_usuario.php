<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Treino Usuario</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../Assets/css/main.css">
  <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
</head>
<body>
  <?php 

  require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Exercicio.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Treino.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Usuario.php");

  session_start();
  include $_SESSION["admin"] == 1 ? "../menu_admin.html" : "../menu.html";

  if(isset($_SESSION["msg"])){
    $msg = $_SESSION["msg"];
    $html = "<div class='alert alert-info text-center'><strong>$msg</strong></div>";
    echo $html;
    unset($_SESSION["msg"]);
  }

  $usuario = new Usuario();
  $usuario = $usuario->buscar($_SESSION['codigoUsuario']);

  $treino = new Treino();
  $treino = $treino->buscar($usuario->getTreino());

  ?>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php echo $html = empty($treino->getNome()) ? "<h2>Nenhum Treino Ativo</h2>" : "<h2>Treino Ativo: " . $treino->getNome() . "</h2>"; ?>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">Sessões</th>
              <th scope="col">Nome</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            
            $exercicioSessoes = Treino::buscaTreinoExercicio($usuario->getTreino());

            foreach($exercicioSessoes as $exercicioSessao){
              $sessaoExercicio = explode(":", $exercicioSessao);
              $codigo = $sessaoExercicio[0];
              $sessao = $sessaoExercicio[1];
              $exercicio = new Exercicio;
              $exercicio = $exercicio->buscar($sessaoExercicio[2]);
              $status = $exercicio->buscaStatus($codigo);

              $customAtributo = "";
              $customClass = "";

              switch($status){
                case 1:
                $customAtributo .= "disabled";
                break;

                case 3:
                $customAtributo .= "disabled";
                $customClass .= 'finalizado';
                break;

                case 4:
                $customAtributo .= "disabled";
                $customClass .= 'pulou';
                break;

                default:
                break;
              }

              $html = "
              <tr class='$customClass'>
              <td> $sessao </td>
              <td>" . $exercicio->getNome() . "</td>
              <td>
              <form action='../Controllers/ExercicioControl.php?action=atualizaStatus&codigo=$codigo&codUsuario=" . $usuario->getcodigo() . "'  method='POST'>
              <button name='status' type='submit' class='btn btn-primary' value='3' $customAtributo>Finalizar</button>
              <button name='status' type='submit' class='btn btn-danger'  value='4' $customAtributo>Pular</button>
              </form>
              </td>
              </tr>";
              echo $html;
            }

            ?>
          </tbody>
        </table>
        <a href="../Controllers/UsuarioControl.php?action=finalizar&codigo=<?php echo $usuario->getCodigo() ?>" type="button" class="btn btn-primary">Encerrar Treino</a>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/f696ad2a76.js" crossorigin="anonymous"></script>
</body>
</html>
