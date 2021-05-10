<?php

use Tecnofit\Controllers\Aluno;
use Tecnofit\Controllers\Exercicios;
use Tecnofit\Controllers\Treino;

require_once __DIR__ . "/../vendor/autoload.php";

$treino = new Treino();
$alunos = new Aluno();
$exercicios = new Exercicios();

$todosTreinos = count($treino->index());
$todosAlunos = count($alunos->index());
$todosExercicios = count($exercicios->index());

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include_once __DIR__ . "/includes/head.php"; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php include_once __DIR__ . "/includes/navbar.php"; ?>
    <?php include_once __DIR__ . "/includes/sidebar.php"; ?>
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

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?php echo $todosTreinos ?></h3>
                                <p>Total de Treinos</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?php echo $todosExercicios; ?><sup style="font-size: 20px"></sup></h3>

                                <p>Total de Exercicios</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?php echo $todosAlunos; ?></h3>

                                <p>Total de Alunos</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <?php include_once __DIR__ . "/includes/footer.php"; ?>
</div>
<?php include_once __DIR__ . "/includes/scripts.php" ?>
</body>
</html>
