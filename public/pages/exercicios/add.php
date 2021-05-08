<?php
use Tecnofit\Controllers\Aluno;
use Tecnofit\Controllers\Treino;

require_once __DIR__ . "/../../../vendor/autoload.php";

$exercicio = new Aluno();
$treino = new Treino();

$todosTreinos = $treino->getAllTreinos();

if (!empty($_POST)) {
    $exercicio->add($_POST);
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
                            <h2>Adicionar<strong>Aluno</strong></h2>
                        </div>
                    </div>
                    <form class="col-7" method="post">
                        <div class="form-group">
                            <label for="inputName">Nome</label>
                            <input type="text" name="nome" id="inputName" class="form-control" required/>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">E-Mail</label>
                            <input type="email" name="email" id="inputEmail" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="inputSubject">Treino</label>
                            <select name="treino" class="custom-select rounded-0" required>
                                <option disabled>Selecione...</option>
                                <?php if (!empty($todosTreinos)) {
                                    foreach ($todosTreinos as $treinos) { ?>
                                        <option value="<?php echo $treinos['id']; ?>">
                                            <?php echo $treinos['nome'] ?>
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
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
