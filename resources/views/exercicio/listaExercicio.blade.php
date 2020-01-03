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
        <h1 style="text-align: center;">Listagem de exercícios</h1>
        <hr>
        <div class="container">
            <table class="table table-bordered table-striped table-sm">
                <thead>
              <tr>
<!-- Criação da tabela -->
                  <th>#</th>
                  <th>Nome exercício</th>
                  <th>Descrição do exercicio</th>
                  <th>Ação</th>
              </tr>
                </thead>
                <tbody>
<!-- Populando a tabela -->
              @forelse($exercicios as $exercicio)
              <tr>
<!-- Populando a tabela -->
                  <td>{{ $exercicio->ID_EXERCICIO }}</td>
                  <td>{{ $exercicio->NOME_EXERCICIO }}</td>
                  <td>{{ $exercicio->DESCRICAO_EXERCICIO }}</td>
                  <td>
<!-- Botões de ação -->
                    <form method="POST" action="{{url('/exercicio/delete')}}/{{$exercicio->ID_EXERCICIO}}">
                      {{csrf_field()}}
                      {{method_field('DELETE')}}
                      <button type="submit" class="btn btn-danger">Excluir</button>
                      <a href="{{url('/exercicio/editarExercicio')}}/{{$exercicio->ID_EXERCICIO}}" class="btn btn-primary">Editar</a>
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
            {{$exercicios->links()}}
        </div>
        <div>
          <a href="{{url('')}}" class="btn btn-primary col-md-offset-5">Voltar</a>
        </div> 
    </body>
</html>
