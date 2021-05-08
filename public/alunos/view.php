<?php
use Tecnofit\Controllers\Aluno;
use Tecnofit\Controllers\Exercicios;
use Tecnofit\Controllers\Treino;

require_once __DIR__ . "/../../vendor/autoload.php";

$aluno = new Aluno();
$treino = new Treino();
$exercicio = new Exercicios();

if (empty($_GET['id'])) {
    header("location:index.php");
}

$exercicioID = $_GET['id_exercicio'] ?? 0;

$alunoID = $aluno->edit($_GET['id']);
$treinoAluno = $treino->getTreinoAluno($_GET['id'], $exercicioID);

if (!empty($_POST)){
    $treino->finalizarTreino($alunoID[0]['aluno_id']);
    header("location:index.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include_once __DIR__ . "/../includes/head.php"; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php include_once __DIR__ . "/../includes/navbar.php"; ?>
    <?php include_once __DIR__ . "/../includes/sidebar.php"; ?>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <form class="card-body box-profile" method="post">
                                <h3 class="profile-username text-center">
                                    <?php echo $treinoAluno['mensagem'] ?? $alunoID[0]['aluno_nome'] ?>
                                </h3>
                                <p class="text-muted text-center"><?php echo $treinoAluno['observacao'] ?? $alunoID[0]['treino'] ?></p>
                                <input type="hidden" name="finalizar_treino">
                                <button class="btn btn-primary btn-block" type="submit">
                                    <b>Finalizar</b>
                                </button>
                            </form>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <!-- /.card -->
                    <?php if (!empty($treinoAluno) && !isset($treinoAluno['mensagem'])) { ?>
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a class="nav-link active"
                                               href="<?php echo $exercicio->proximoExercicio($exercicioID); ?>">
                                                Proximo
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <!-- Post -->
                                            <div class="post">
                                                <div class="user-block">
                                                    <h1><?php echo $treinoAluno['exercicio']; ?></h1>
                                                    <p>Total de repetições
                                                        : <?php echo $treinoAluno['repeticoes']; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
        </section>
    </div>
    <?php include_once __DIR__ . "/../includes/footer.php"; ?>
</div>
<?php include_once __DIR__ . "/../includes/scripts.php" ?>
</body>
</html>
