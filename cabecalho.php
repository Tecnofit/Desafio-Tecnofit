<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Academia 1.0</title>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/datepicker.css" rel="stylesheet">
    <link href="css/projetos.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">
    
    <script src="js/nicEdit.js" type="text/javascript"></script>
    <style>
      body {
        padding-top: 60px;
      }
    </style>
    <script type='text/javascript' src="js/jquery.js"></script>
    <script type='text/javascript' src="js/bootstrap-datepicker.js"></script>
    <script type='text/javascript' src="js/jquery.tablednd.0.7.min.js"></script>
  </head>
<body>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="academia" href="index.php">Academia</a>
          <a class="brand" href="index.php">Academia</a>

          <?php          
          if (is_logged()) {
          ?>
          <ul class="nav pull-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <?=$_SESSION['l_nome']?> <b class="caret"></b></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                  <li><a href="ger-treino-usuario.php">Administração</a></li>
                  <li><a href="ger-perfil.php">Editar Perfil</a></li>
                  <li class="divider"></li>
                  <li><a href="login.php?act=logout">Sair</a></li>
              </ul>
            </li>
          </ul>
          <?php
          }
          ?>
        </div>
      </div>
    </div> <!-- .navbar -->

    <div class="container" <?php echo (($ger_slug  == "ger-visualizacao") ? "style='width:100%;'" : "");?> >