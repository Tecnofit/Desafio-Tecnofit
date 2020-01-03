<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name', 'Laravel')}}</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js" type="text/javascript"></script>
<!-- Styles -->
        <link href="{{ asset('css/app.css')}}" rel="stylesheet">
        <script>
            $(document).ready(function(){
                $("#CPF").mask("000.000.000-00")
            })
        </script>
    </head>

    <body>
        <h1 style="text-align: center;">Informações do aluno</h1>
        <hr>
<!-- Cria a visualização do aluno -->
        <div class="container">
            <div class="card" >
                <dl class="dl-horizontal">
                    <dt>ID:</dt>
                    <dd>{{$aluno->ID}}</dd>
                    <dt>Nome :</dt>
                    <dd>{{ $aluno->NOME}}</dd>
                    <dt>CPF:</dt>
                    <dd>{{ $aluno->CPF}}</dd>
                    <dt>Data de nascimento:</dt>
                    <dd>{{ \Carbon\Carbon::parse($aluno->DATA_NASCIMENTO)->format('d/m/Y')}}</dd>
                    <dt>Observação:</dt>
                    <dd>{{ $aluno->OBS}}</dd>
                </dl>
                <div id="actions" class="row">
                    <div class="col-md-12">
                        <a href="{{url('/aluno/editarAluno')}}/{{$aluno->ID}}" class="btn btn-warning">Editar</a>
                        <a href="{{url('/treino/create')}}/{{$aluno->ID}}" class="btn btn-primary">Cadastrar treino</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <h3 style="text-align: center;">Treinos do aluno</h3>
        <hr>
<!-- Cria a visualização dos treinos do aluno-->
          <div class="container">
            <table class="table table-bordered table-striped table-sm">
                <thead>
              <tr>
                  <th>#</th>
                  <th>Nome do treino</th>
                  <th>Status</th>
              </tr>
                </thead>
                <tbody>
              @forelse($treinos as $treino)
                  <tr>
<!--Verifica o ID do aluno na ficha para apresentar somente as fichas dos aluno que tenha o ID informado -->
                    @if($treino->ID_ALUNO_FICHA === $aluno->ID)
                      <td>{{ $treino->ID_FICHA}}</td>
                      <td>{{ $treino->NOME_FICHA}}</td>
                      <td>@if($treino->STATUS === 0)
                            Inativo
                          @else
                            Ativo
                          @endif
                      </td>
                      <td>
                    @else
                    @endif
<!-- Reparar essa função, para realizar a exclusão da ficha ou editar a ficha -->
                       <!-- <form method="POST" action="{{url('/treino/delete')}}/{{$treino->ID}}">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                          <button type="submit" class="btn btn-danger">Excluir</button>
                          <a href="{{url('/treino/editarTreino')}}/{{$treino->ID_FICHA}}" class="btn btn-warning">Editar</a>
                          <a href="{{url('/treino/visualizarAluno')}}/{{$treino->ID_FICHA}}" class="btn btn-primary">Visualizar</a>
                        </form>
                      </td>-->
                  </tr>
                  @empty
                  <tr>
                      <td colspan="6">Nenhum registro encontrado para listar</td>
                  </tr>
              @endforelse
                </tbody>
            </table>
        </div>
    </body>
</html>
