<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name', 'Laravel')}}</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js" type="text/javascript"></script>
<!-- Styles -->
        <link href="{{ asset('css/app.css')}}" rel="stylesheet">

    </head>

    <body>
      <!-- Primeira linha de cards -->
        <div class="row" style="margin-top: 3em;">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Cadastro de alunos</h4>
                <p class="card-text">Clique no botão abaixo para realizar o cadastro do aluno</p>
                <a href="{{url('/aluno/create')}}" class="btn btn-primary">Cadastrar aluno</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Cadastro de exercicios</h4>
                <p class="card-text">Clique no botão abaixo para realizar o cadastro de exercicios</p>
                <a href="{{url('exercicio/createExercicio')}}" class="btn btn-primary">Cadastrar exercicio</a>
              </div>
            </div>
          </div>
        </div>
        <!-- Segunda linha de cards --> 
        <div class="row" style="margin-top: 3em;">
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Lista de alunos cadastrados</h4>
                <p class="card-text">Clique no botão abaixo para verificar os alunos cadastrados</p>
                <a href="{{url('/aluno/listaAluno')}}" class="btn btn-primary">Lista de alunos</a>
              </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Lista de exercícios cadastrados</h4>
                <p class="card-text">Clique no botão abaixo para verificar os exercícios cadastrado</p>
                <a href="{{url('/exercicio/listaExercicio')}}" class="btn btn-primary">Lista de exercícios</a>
              </div>
            </div>
          </div>
        </div>
    </body>
</html>
