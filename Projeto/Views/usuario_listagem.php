<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Listagem de Usuários</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../Assets/css/main.css">
  <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
</head>
<body>
  <?php 

  require_once($_SERVER['DOCUMENT_ROOT'] . "\Projeto\Models\Usuario.php");
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
       <a href="usuario_cadastro.php" type="button" class="btn btn-primary">Cadastrar</a>
       <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Login</th>
            <th scope="col">Treino Ativo</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php 

          $usuarios = [];
          $usuarios = Usuario::listar();

          foreach($usuarios as $usuario){
            $treinoUsuario = New Treino();
            if($usuario->getTreino() != 0){
              $treinoUsuario = $treinoUsuario->buscar($usuario->getTreino());
            }

            $html = $usuario->getAdmin() == 1 ? "<tr class='admin'>" : "<tr>";
            $html .= 
            "<th scope='row'>" . $usuario->getCodigo() . "</th>
            <td>" . $usuario->getNome() . "</td>
            <td>" . $usuario->getLogin() . "</td>
            <td>" . $treinoUsuario->getNome() . "</td>
            <td>
            <a href='../Controllers/UsuarioControl.php?action=buscar&codigo=" . $usuario->getCodigo() . "' type='button' class='btn btn-success'><i class='far fa-edit'></i></a>
            <a href='../Controllers/UsuarioControl.php?action=excluir&codigo=" . $usuario->getCodigo() . "' type='button' class='btn btn-danger'><i class='far fa-trash-alt'></i></a>
            <button type='button' name='ativar' class='btn btn-primary' data-toggle='modal' value=" . $usuario->getCodigo() . " data-target='#exampleModal'>Ativar Treino</button>
            </td>
            </tr>";
            echo $html;
          }

          ?>
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Treinos</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form class="form-signin" action=../Controllers/UsuarioControl.php?action=ativaTreino method="POST">
                  <div class="modal-body">
                    <input type="hidden" id="ativarModal" name="codigo" value="">
                    <?php

                    $treinos = [];
                    $treinos = Treino::listar();

                    $listaTreinos = "<option value='0'>-- Desativar --</option>";
                    foreach($treinos as $treino){
                      $listaTreinos .= "<option value='" . $treino->getCodigo() . "'>" . $treino->getNome() . "</option>";
                    }
                    
                    $html = "
                    <div class='form-group row'>
                    <select class='form-control col-9 offset-1' name='treino'>
                    $listaTreinos
                    </select>
                    </div>";
                    echo $html;

                    ?>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Ativar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script src="../Assets/js/jquery.js"></script>
<script src="../Assets/js/bootstrap.min.js"></script>
<script src="../Assets/js/main.js"></script>
<script src="../Assets/css/main.css"></script>
<script src="https://kit.fontawesome.com/f696ad2a76.js" crossorigin="anonymous"></script>
</script>
</body>
</html>
