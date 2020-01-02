<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Controle de Treinos</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/0c2bcd6077.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <div class="jumbotron">
      <h2><a href="/">Início</a></h2>
      <h1>@yield('cabecalho')</h1>
    </div>
    @yield('conteudo')
  </div>
</body>
</html>