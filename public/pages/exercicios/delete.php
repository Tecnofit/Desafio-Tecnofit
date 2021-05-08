<?php
use Tecnofit\Controllers\Exercicios;

require_once __DIR__ . "/../../../vendor/autoload.php";

$exercicio = new Exercicios();

if (empty($_GET['id'])) { header("location:index.php"); }

$exercicioID = $exercicio->edit($_GET['id']);

if (!empty($_POST)) {
    $retorno = $exercicio->delete($exercicioID[0]['id']);
    if ($retorno) {
        header("location:index.php");
    }
}?>

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
                       <?php if (isset($retorno) && $retorno == false) { ?>
                           <div class="form-group">
                               <h4>Não é possivel deletar um exercicio ativo em um treino.</h4>
                               <a href="index.php" class="btn btn-primary">Voltar</a>
                           </div>
                        <?php } else { ?>
                        <div class="form-group">
                            <h2>Deletar o Exercicio : <?php echo $exercicioID[0]['nome']; ?> ?</h2>
                            <input type="hidden" value="deletar" name="deletar">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Deletar">
                        </div>
                        <?php } ?>
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
