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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Projects</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
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
                        <tr>
                            <td>
                                #
                            </td>
                            <td>
                                <a>
                                   Hiago Klapowsko
                                </a>
                            </td>
                            <td class="project_progress">
                                <small>
                                    Treino Funcional
                                </small>
                            </td>
                            <td class="project-state">
                                <span class="badge badge-success">Ativo</span>
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-folder">
                                    </i>
                                    View
                                </a>
                                <a class="btn btn-info btn-sm" href="#">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Editar
                                </a>
                                <a class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash">
                                    </i>
                                    Deletar
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <?php include_once __DIR__ . "/includes/footer.php"; ?>
</div>
<?php include_once __DIR__ . "/includes/scripts.php" ?>
</body>
</html>
