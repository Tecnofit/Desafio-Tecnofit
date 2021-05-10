<?php

use Tecnofit\Controllers\Exercicios;
use Tecnofit\Controllers\Treino;

require_once __DIR__ . "/../../../vendor/autoload.php";

$treino = new Treino();
$exercicios = new Exercicios();

if (empty($_GET['id']) || empty($_GET['id_exercicio'])) { header("location:index.php"); }

$exercicio = $exercicios->edit($_GET['id_exercicio']);

if (!empty($_POST)) {
    $treino->deletarExercicio($_GET['id'], $_GET['id_exercicio']);
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
                            <h2>Deletar<strong>Exercicio</strong></h2>
                        </div>
                    </div>
                    <form class="col-7" method="post">
                        <div class="form-group">
                            <h2>Deletar o Exercicio : <?php echo $exercicio[0]['nome']; ?> ?</h2>
                            <input type="hidden" value="deletar" name="deletar">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Deletar">
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
