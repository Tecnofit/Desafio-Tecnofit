<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{config('app.name', 'Laravel')}}</title>
<!-- Styles -->
        <link href="{{ asset('css/app.css')}}" rel="stylesheet">

    </head>

    <body>
<!-- Painel de cadastro de alunos -->
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
<!-- Titulo do form -->
                        <div class="panel-heading"><h1 style="text-align: center;">Cadastro de exercicio</h1></div>
                        <div class="panel-body">
<!-- Inicio do Forms -->
                            <form class="form-horizontal" action="{{url('/exercicio/store')}}" role="form" method="POST" >
<!-- Mensagem de erro em casos de falha do cadastro // Aprender a alterar a mensagem-->
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error}}</li>
                                        @endforeach
                                    </div>
                                @endif
<!--Mensagem de sucesso ao cadastra o exercício -->
                                @if(Session::has('ExercicioAdded'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{{Session::get('ExercicioAdded')}}</li>
                                        </ul>
                                    </div>
                                @endif
<!-- Token de validação Laravel -->
                                {{csrf_field()}}
                                <div class="form-group"> 
<!-- Forms de cadastro do exercício -->                  
                                    <label for="name_exercio" style="margin-left: -4%;" class="col-md-3 control-label">Nome do exercício</label>
                                    <div class="col-md-10">
                                        <input type="text" name="NOME_EXERCICIO" class="form-control" autofocus />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="descricao" style="margin-left: -4%;" class=" col-md-2 control-label">Descrição</label>
                                    <div class="col-md-11" style="margin-left: 0%;">
                                        <textarea name="DESCRICAO_EXERCICIO" class="form-control" rows="5" cols="50"></textarea>
                                    </div>
                                </div>
<!-- Botões -->
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">Adicionar exercício</button>
                                            <a href="{{url('')}}" class="btn btn-danger">Cancelar</a>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>   
                </div>
            </div>
        </div>   
    </body>
</html>
