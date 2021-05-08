<?php

use Tecnofit\Controllers\Exercicios;
use Tecnofit\Controllers\Treino;

require_once __DIR__ . "/../../../vendor/autoload.php";

$treino = new Treino();
$exercicio = new Exercicios();

if (empty($_GET['id'])) {
    header("location:index.php");
}

$todosExercicios = $exercicio->index();

if (!empty($_POST)) {
    $treino->addExercicio($_POST, $_GET['id']);
    header(sprintf("location:edit.php?id=%s" , $_GET['id']));
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include_once __DIR__ . "/../../includes/head.php"; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php include_once __DIR__ . "/../../includes/navbar.php"; ?>
    <?php include_once __DIR__ . "/../../includes/sidebar.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Sistema de Gestão - Tecnofit</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="card">
                <div class="card-body row">
                    <div class="col-5 text-center d-flex align-items-center justify-content-center">
                        <div class="">
                            <h2>Adicionar<strong>Exercicio</strong></h2>
                        </div>
                    </div>
                    <form class="col-7" method="post">
                        <div class="form-group">
                            <label>Exercicios</label>
                            <select class="custom-select" name="id_exercicio" required>
                                <option disabled>Selecione..</option>
                                <?php if (!empty($todosExercicios)) {
                                    foreach ($todosExercicios as $exercicio) {
                                        ?>
                                        <option value="<?php echo $exercicio['id'] ?>">
                                            <?php echo $exercicio['nome']; ?>
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputName">Repeticoes</label>
                            <input type="number" name="repeticoes" id="inputName" class="form-control" value="1" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <?php include_once __DIR__ . "/../../includes/footer.php"; ?>
</div>
<?php include_once __DIR__ . "/../../includes/scripts.php" ?>
</body>
</html>