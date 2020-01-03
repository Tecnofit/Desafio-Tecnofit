<?php
session_start();
include __DIR__."/db.php";
include __DIR__."/functions.php";
$db = conn();
$selectAlunos=$FichaExercicios=$treino=$sql='';

$sqlAlunos = 'select * from `alunos`;';
$resultAlunos = $db->query($sqlAlunos);

while ($row = mysqli_fetch_assoc($resultAlunos)) {
  $selectAlunos.="<option value='".$row['nome']."'>".$row['nome']."</option>";
}

if (isset($_POST["nomeAluno"]) and isset($_POST["adicionar"])){
  cadastraFicha($_POST);

}elseif(isset($_POST["nomeAluno"]) and isset($_POST["editar"])){
  atualizaFicha($_POST);

}elseif (isset($_POST["excluir"])) {
  excluiFicha($_POST);

}elseif(isset($_POST["id"]) and isset($_POST["adicionarTreino"])){
  adicionaTreino($_POST);

}elseif (isset($_POST["id"]) and isset($_POST["excluirTreino"])) {
  excluiTreino($_POST);
}

buscaFicha();
?>
<html lang="pt-br">

<head>

<title>Ficha de Exercícios</title>

<?php include("head.php"); ?>

</head>

<body>

  <br>
  <h2>Ficha de Exercícios</h2>
  <br>

  <div class="col-12 row">
    <div class="col-md-3 left-panel-div">
      <table>
        <tbody>
          <div style="text-align: end" class="col-sm-12">
              <a class="btn btn-primary" href="fichaExercicios.php" type="submit" value="+">+ Novo</a>
          </div>
          <?php echo $FichaExercicios; ?>
        </tbody>
      </table>
    </div>

    <div class="col-md-9 right-panel-div">
      <div style="border: 1px solid lightgrey; padding: 15px; border-radius: 5px;">
        <?php if(isset($_SESSION['temp'])){

          if ($_SESSION['temp'] == 1){

            echo "<div class='alert alert-success col-md-10' role='alert' id='temp'>  Cadastro Realizado com Sucesso! </div>";
            unset($_SESSION['temp']);

          }elseif ($_SESSION['temp'] == 2) {

            echo "<div class='alert alert-success col-md-10' role='alert' id='temp'>  Cadastro Alterado com Sucesso! </div>";
              unset($_SESSION['temp']);

          }elseif ($_SESSION['temp'] == 3) {

              echo "<div class='alert alert-danger col-md-10' role='alert' id='temp'>  Cadastro Excluido com Sucesso! </div>";
              unset($_SESSION['temp']);
          }elseif ($_SESSION['temp'] == 'fichaAtiva') {

              echo "<div class='alert alert-warning col-md-10' role='alert' id='temp'>  Possui uma ficha ativa, Alterado para Aguardando Início! </div>";
              unset($_SESSION['temp']);
          }

        }
        ?>

        <?php if (isset($_GET['nomeAluno'])): ?>
          <form id="fichaCadastro" action="FichaExercicios.php" method="post">
            <div class="form-group row">
              <label for="nomeAluno" class="col-sm-1 col-form-label">Aluno</label>
              <div class="col-sm-10 ">
                <select class="form-control" name="nomeAluno">
                  <option selected><?php echo $_GET["nomeAluno"];?></option>
                  <?php echo $selectAlunos;?>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="nomeFicha" class="col-sm-1 col-form-label">Nome</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="nomeFicha" placeholder="Nome da Ficha" name="nomeFicha" value=<?php echo $_GET["nomeFicha"];?> required>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="dataInicio">Data de Início</label>
                <input type="date" class="form-control" id="dataInicio" name="dataInicio" value=<?php echo $_GET["dataInicio"];?> required>
              </div>
              <div class="col-md-5 mb-3">
                <label for="numeroTreinos">Número de Treinos</label>
                <input type="number" class="form-control" id="numeroTreinos" name="numeroTreinos" value=<?php echo $_GET["numeroTreinos"];?> required>
              </div>
            </div>

            <div class="form-group row">
              <label for="cep" class="col-sm-2 col-form-label">Status Ficha</label>
              <div class="col-sm-9">
                <select id="statusFicha" class="form-control" name="statusFicha">
                  <option selected><?php echo $_GET["statusFicha"];?></option>
                  <option value="Ativa">Ativa</option>
                  <option value="Aguardando Início">Aguardando Início</option>
                  <option value="Concluída">Concluída</option>
                </select>
              </div>
            </div>

            <input type="text" name="editar" style="display:none;">
            <input type="text" name="id"  value="<?php echo $_GET['id'] ?>" style="display:none;">

          </form>

          <div class="row">
            <div class="col-sm-6 ">
              <form action="FichaExercicios.php" method="post">
                  <input type="text" name="id"  value="<?php echo $_GET['id'] ?>" style="display:none;">
                  <input type="text" name="excluir" style="display:none;">
                  <input class="btn btn-danger" type="submit" value="Excluir">
              </form>
            </div>

            <div class="col-sm-5 " style="text-align: end">
              <form action="FichaExercicios.php" method="post">
                <input class="btn btn-primary" type="submit" value="Salvar" form="fichaCadastro">
              </form>
            </div>

        </div>
      </div>
        <div style="border: 1px solid lightgrey; padding: 15px; border-radius: 5px;">
          <?php buscaTreino(); ?>
        </div>

        <?php else: ?>

          <form action="FichaExercicios.php" method="post">
          <div class="form-group row">
            <label for="nomeAluno" class="col-sm-1 col-form-label">Aluno</label>
            <div class="col-sm-10 ">
              <select class="form-control" name="nomeAluno">
                <option selected>Escolher...</option>
                <?php echo $selectAlunos;?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="nomeFicha" class="col-sm-1 col-form-label">Nome</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nomeFicha" placeholder="Nome da Ficha" name="nomeFicha">
            </div>
          </div>

          <div class="form-row">
            <div class="col-md-6 mb-3">
              <label for="dataInicio">Data de Início</label>
              <input type="date" class="form-control" id="dataInicio" name="dataInicio" required>
            </div>
            <div class="col-md-5 mb-3">
              <label for="numeroTreinos">Número de Treinos</label>
              <input type="number" class="form-control" id="numeroTreinos" name="numeroTreinos" required>
            </div>
          </div>

          <div class="form-group row">
            <label for="cep" class="col-sm-2 col-form-label">Status Ficha</label>
            <div class="col-sm-9">
              <select id="statusFicha" class="form-control" name="statusFicha">
                <option selected>Escolher...</option>
                <option value="Ativa">Ativa</option>
                <option value="Aguardando">Aguardando Início</option>
                <option value="Concluída">Concluída</option>
              </select>
            </div>
          </div>

          <input type="text" name="adicionar" style="display:none;">

          <div class="col-11" style="text-align: end">
            <input class="btn btn-primary" type="submit" value="Cadastrar Ficha">
          </div>

        </form>
      </div>
        <?php endif; ?>

        </div>
      </div>
    </div>
    <script type="text/javascript">
    function addmore(){
      x=document.getElementById('form');
      var z ="<div class='form-row row'><div class='col-md-3 mb-3'><select id='nomeExercicio' name='nomeExercicio[]' class='form-control'><?php echo $selectExercicios; ?></select></div><div class='col-md-3 mb-3'><input type='text' class='form-control' id='serie' name='serie[]'></div><div class='col-md-3 mb-3'><input type='text' class='form-control' id='repeticao' name='repeticao[]'></div><div class='col-md-2 mb-3'><input type='text' class='form-control' id='carga' name='carga[]'></div></div>";
      x.insertAdjacentHTML("beforeend",z);
    }
    </script>
  <?php include("bootstrap.php"); ?>

</body>
