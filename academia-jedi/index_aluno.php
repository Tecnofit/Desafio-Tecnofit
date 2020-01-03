<?php
session_start();
?>

<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Academia Jedi - Área do Aluno</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <img src="https://i.ibb.co/DD5WZ8w/star-wars-jedi-knight-jedi-academy-the-new-jedi-order-logo-war.png" width="250" height="250">
                    <br></br>
                    <h3 class="title has-text-grey">Área do aluno</h3>
                    <?php
                    if(isset($_SESSION['nao_localizado'])):
                    ?>
                    <div class="notification is-danger">
                      <p>ERRO: Não foi possível localizar este aluno.</p>
                    </div>
                    <?php
                    endif;
                    unset($_SESSION['nao_localizado']);
                    ?>
                    <div class="box">
                        <form action="login_aluno.php" method="POST">
                            <div class="field">
                                <div class="control">
                                    <input name="idaluno" type="text" class="input is-large" placeholder="Código do aluno" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input name="email" type="text" class="input is-large" placeholder="E-mail do aluno">
                                </div>
                            </div>


                            <div class="field">
                            <button type="submit" class="button is-block is-link is-large is-fullwidth">Entrar</button>
                        </div>
                                <a href="index.php">Voltar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>