<?php

use Tecnofit\Controllers\Aluno;

require_once __DIR__ . "/../../vendor/autoload.php";

$aluno = new Aluno();
$alunoID = $aluno->index();
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
            <div class="card">
                <div class="card-body row">
                    <div class="col-5 text-center d-flex align-items-center justify-content-center">
                        <div class="">
                            <h2>Editar<strong>Aluno</strong></h2>
                        </div>
                    </div>
                    <div class="col-7">
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input type="text" id="inputName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">E-Mail</label>
                            <input type="email" id="inputEmail" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputSubject">Subject</label>
                            <input type="text" id="inputSubject" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="inputMessage">Message</label>
                            <textarea id="inputMessage" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Send message">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include_once __DIR__ . "/../includes/footer.php"; ?>
</div>
<?php include_once __DIR__ . "/../includes/scripts.php" ?>
</body>
</html>
