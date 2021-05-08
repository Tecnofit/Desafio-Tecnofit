<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

use Tecnofit\Controllers\Treino;

require_once __DIR__ . "/../../../vendor/autoload.php";

$treino = new Treino();

if (empty($_GET['id'])) { header("location:index.php"); }

$treinoID = $treino->edit($_GET['id']);
$todosTreinos = $treino->getAllTreinos();

if (!empty($_POST)) {
    $treino->update($_POST, $treinoID[0]['aluno_id']);
    header("location:index.php");
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
                            <h2>Editar<strong>Treino</strong></h2>
                        </div>
                    </div>
                    <form class="col-7" method="post">
                        <div class="form-group">
                            <label for="inputName">Nome</label>
                            <input type="text" name="nome" id="inputName" class="form-control"
                                   value="<?php echo $treinoID[0]['nome']; ?>">
                        </div>
                        <div class="form-group">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h3 class="card-title">Exercicios</h3>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <a class="btn btn-outline-success" href="add-exercicio.php?id=<?php echo $_GET['id'] ?>">Adicionar Exercicio</a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body p-0">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Nome</th>
                                            <th>Repetições</th>
                                            <th style="width: 40px">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>Supino Reto</td>
                                            <td>4</td>
                                            <td>
                                                <a class="btn btn-danger btn-sm"
                                                   href="deletar-exercicio.php?id=<?php echo $_GET['id']; ?>">
                                                    <i class="fas fa-trash"></i>
                                                    Deletar
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
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
