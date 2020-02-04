
<!DOCTYPE html>
<html lang="pt">
<head>
  <title>Academia</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<h2>Academia</h2>
    <div class ="row">
        
            <form action="autenticacao.php" method='POST'>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" placeholder="Digite aqui seu email" id="idLogin" name="nmLogin">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" placeholder="Senha" id="idSenha" name="nmSenha">
                </div>
                <button type="submit" class="btn btn-primary">Entrar</button>
            </form>
    </div>
</div>

</body>
</html>
