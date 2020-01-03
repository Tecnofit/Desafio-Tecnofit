<?php
session_start();
include __DIR__."/db.php";
include __DIR__."/functions.php";
$db = conn();
$exercicios='';


if (isset($_POST["nomeExercicio"]) and isset($_POST["adicionarExercicio"])){
  cadastrarExercicio($_POST);

}elseif(isset($_POST["nomeExercicio"]) and isset($_POST["editar"])){
  atualizaExercicio($_POST);

}elseif (isset($_POST["excluir"])) {
  excluiExercicio($_POST);

}
buscaExercicios();

?>

<html lang="pt-br">

<head>
<title>Exercícios</title>
<?php include("head.php"); ?>
</head>

<body>

  <br><h2>Exercícios</h2><br>

  <?php if (isset($_GET['nomeExercicio'])): ?>

    <div class="col-12 row">

      <div class="col-md-3 left-panel-div">
        <table>
          <tbody>
            <div style="text-align: end" class="col-sm-12">
                <a class="btn btn-primary" href="exercicios.php" type="submit" value="+">+ Novo</a>
            </div>
            <?php echo $exercicios; ?>
          </tbody>
        </table>
      </div>

      <div class="col-md-9 right-panel-div">

      <form id="exerciciosCadastro" method="post" action="exercicios.php">
        <div class="form-group row">
          <label for="grupoMuscular" class="col-sm-2 col-form-label">Grupo Muscular</label>
          <div class="col-sm-9">
            <select id="grupoMuscular" class="form-control" name="grupoMuscular">
              <option selected><?php echo $_GET["grupoMuscular"]; ?></option>
              <option value="Abdômen">Abdômen</option>
              <option value="Aeróbico">Aeróbico</option>
              <option value="Antebraço">Antebraço</option>
              <option value="Bícipes">Bícipes</option>
              <option value="Costas">Costas</option>
              <option value="Glúteo">Glúteo</option>
              <option value="Ombro">Ombro</option>
              <option value="Panturrilha">Panturrilha</option>
              <option value="Peito">Peito</option>
              <option value="Perna">Perna</option>
              <option value="Trapézio">Trapézio</option>
              <option value="Tríceps">Tríceps</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="nomeExercicio" class="col-sm-2 col-form-label">Nome</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="nomeExercicio" name="nomeExercicio" value=<?php echo $_GET["nomeExercicio"]; ?> required>
          </div>
        </div>

        <div class="form-group row">
          <label for="descricaoExercicio" class="col-sm-2 col-form-label">Descrição</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="descricaoExercicio" name="descricaoExercicio" value=<?php echo "'".$_GET["descricaoExercicio"]."'";?>>
          </div>
        </div>

        <input type="text" name="editar" style="display:none;">

        <input type="text" name="id"  value="<?php echo $_GET['id'] ?>" style="display:none;">
        </form>

        <div class="row">

          <div class="col-sm-6 " "text-align: end">
            <form action="exercicios.php" method="post">
              <input type="text" name="excluir" style="display:none;">
              <input type="text" name="id"  value="<?php echo $_GET['id'] ?>" style="display:none;">
              <input type="text" name="nomeExercicio"  value="<?php echo $_GET['nomeExercicio'] ?>" style="display:none;">
              <input class="btn btn-danger" type="submit" value="Excluir">
            </form>
          </div>

          <div class="col-sm-5" style="text-align: end">
            <input class="btn btn-primary" type="submit" value="Salvar" form="exerciciosCadastro">
          </div>

        </div>

      </div>
    </div>

  <?php else: ?>

    <div class="col-12 row">
      <div class="col-md-3 left-panel-div">
        <table>
          <tbody>
            <div style="text-align: end" class="col-sm-12">
                <a class="btn btn-primary" href="exercicios.php" type="submit" value="+">+ Novo</a>
            </div>
            <?php echo $exercicios; ?>
          </tbody>
        </table>
      </div>
      <div class="col-md-9 right-panel-div">
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
        }elseif ($_SESSION['temp'] == 5) {

            echo "<div class='alert alert-danger col-md-10' role='alert' id='temp'> Não é possível excluir exercícios vinculados a uma ficha de treino!</div>";
            unset($_SESSION['temp']);
        }

      }
      ?>
      <form method="post" action="exercicios.php">
        <div class="form-group row">
          <label for="grupoMuscular" class="col-sm-2 col-form-label">Grupo Muscular</label>
          <div class="col-sm-9">
            <select id="grupoMuscular" class="form-control" name="grupoMuscular">
              <option selected>Escolher...</option>
              <option value="Abdômen">Abdômen</option>
              <option value="Aeróbico">Aeróbico</option>
              <option value="Antebraço">Antebraço</option>
              <option value="Bícipes">Bíceps</option>
              <option value="Costas">Costas</option>
              <option value="Glúteo">Glúteo</option>
              <option value="Ombro">Ombro</option>
              <option value="Panturrilha">Panturrilha</option>
              <option value="Peito">Peito</option>
              <option value="Perna">Perna</option>
              <option value="Trapézio">Trapézio</option>
              <option value="Tríceps">Tríceps</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label for="nomeExercicio" class="col-sm-2 col-form-label">Nome</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="nomeExercicio" name="nomeExercicio" required>
          </div>
        </div>

        <div class="form-group row">
          <label for="descricaoExercicio" class="col-sm-2 col-form-label">Descrição</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="descricaoExercicio" name="descricaoExercicio" >
          </div>
        </div>

        <input type="text" name="adicionarExercicio" style="display:none;">

        <div style="text-align: end" class="col-sm-11">
          <input class="btn btn-primary" type="submit" value="Cadastrar">
        </div>

      </div>
    </div>

    </form>
  <?php endif; ?>

  <?php include("bootstrap.php"); ?>

</body>
