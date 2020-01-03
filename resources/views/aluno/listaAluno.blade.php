<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name', 'Laravel')}}</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!-- Styles -->
        <link href="{{ asset('css/app.css')}}" rel="stylesheet">

    </head>

    <body>
<!-- Titulo da lista -->
        <h1 style="text-align: center;">Listagem de Clientes</h1>
        <hr>
        <div class="container">
            <table class="table table-bordered table-striped table-sm">
                <thead>
<!-- Criação da tabela -->
              <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>CPF</th>
                  <th>Ação</th>
              </tr>
                </thead>
                <tbody>
              @forelse($alunos as $aluno)
              <tr>
<!-- Populando a tabela -->
                  <td>{{ $aluno->ID}}</td>
                  <td>{{ $aluno->NOME}}</td>
                  <td>{{ $aluno->CPF}}</td>
                  <td>
                    <form method="POST" action="{{url('/aluno/delete')}}/{{$aluno->ID}}">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
<!-- Botões de ação -->
                      <button type="submit" class="btn btn-danger">Excluir</button>
                      <a href="{{url('/aluno/editarAluno')}}/{{$aluno->ID}}" class="btn btn-warning">Editar</a>
                      <a href="{{url('/aluno/visualizarAluno')}}/{{$aluno->ID}}" class="btn btn-primary">Visualizar</a>
                    </form>
                </form>
                  </td>
              </tr>
<!--Quando não houver dados para popular a tabela vai retornar a mensagem abaixo -->
              @empty
              <tr>
                  <td colspan="6">Nenhum registro encontrado para listar</td>
              </tr>
              @endforelse
                </tbody>
            </table>
<!--Faz a paginação -->
            {{$alunos->links()}}
      </div>
        <div>
          <a href="{{url('')}}" class="btn btn-primary col-md-offset-5">Voltar</a>
        </div> 
    </body>
</html>
