<?php
use Tecnofit\Controllers\Exercicios;

require_once __DIR__ . "/../../../vendor/autoload.php";

$exercicios = new Exercicios();
$todosExercicios = $exercicios->index();

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
                        <h1 class="m-0">Exercicios - Tecnofit</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="d-flex mb-2 mr-2 justify-content-end">
                <a href="add.php" type="button" class="btn btn-outline-primary">Adicionar Exercicio</a>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Exercicios</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <th style="width: 1%">
                                #
                            </th>
                            <th style="width: 20%">
                                Nome
                            </th>
                            <th style="width: 8%" class="text-center">
                                Status
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($todosExercicios)) {
                            foreach ($todosExercicios as $exercicio) { ?>
                                <tr>
                                    <td>
                                        #
                                    </td>
                                    <td>
                                        <a>
                                            <?php echo $exercicio['nome']; ?>
                                        </a>
                                    </td>
                                    <td class="project-state">
                                        <span class="badge badge-success">Ativo</span>
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm"
                                           href="<?php echo sprintf("edit.php?id=%s", $exercicio['id']) ?>">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Editar
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                           href="<?php echo sprintf("delete.php?id=%s", $exercicio['id']) ?>">
                                            <i class="fas fa-trash">
                                            </i>
                                            Deletar
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <?php include_once __DIR__ . "/../../includes/footer.php"; ?>
</div>
<?php include_once __DIR__ . "/../../includes/scripts.php" ?>
</body>
</html>
