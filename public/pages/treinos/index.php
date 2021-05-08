<?php
use Tecnofit\Controllers\Treino;

require_once __DIR__ . "/../../../vendor/autoload.php";

$treinos = new Treino();
$todosTreinos = $treinos->index();
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
                        <h1 class="m-0">Treinos - Tecnofit</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Treinos</h3>
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
                            <th style="width: 30%">
                                Treino
                            </th>
                            <th style="width: 8%" class="text-center">
                                Status
                            </th>
                            <th style="width: 20%">
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($todosTreinos)) {
                            foreach ($todosTreinos as $treino) { ?>
                                <tr>
                                    <td>
                                        #
                                    </td>
                                    <td>
                                        <a>
                                            <?php echo $treino['aluno']; ?>
                                        </a>
                                    </td>
                                    <td class="project_progress">
                                        <small>
                                            <?php echo $treino['treino']; ?>
                                        </small>
                                    </td>
                                    <td class="project-state">
                                        <span class="badge badge-success">Ativo</span>
                                    </td>
                                    <td class="project-actions text-right">
                                       <?php if ($treino['treino_id']) { ?>
                                            <a class="btn btn-primary btn-sm"
                                               href="<?php echo sprintf("view.php?id=%s", $treino['aluno_id']) ?>">
                                                <i class="fas fa-folder">
                                                </i>
                                                View
                                            </a>
                                        <?php } ?>
                                        <a class="btn btn-info btn-sm"
                                           href="<?php echo sprintf("edit.php?id=%s", $treino['aluno_id']) ?>">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Editar
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                           href="<?php echo sprintf("delete.php?id=%s", $treino['aluno_id']) ?>">
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
