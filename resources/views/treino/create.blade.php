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
    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
<!-- Titulo do form -->
                        <div class="panel-heading"><h1 style="text-align: center;">Ficha de exercício</h1></div>
                        <div class="panel-body">
<!-- Inicio do Forms -->
                            <form class="form-horizontal" action="{{url('/treino/store')}}" role="form" method="POST" >
<!-- Mensagem de erro em casos de falha do cadastro // Aprender a alterar a mensagem-->
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error}}</li>
                                        @endforeach
                                    </div>
                                @endif
<!--Mensagem de sucesso ao cadastrar-->
                                @if(Session::has('TreinoAdded'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{{Session::get('TreinoAdded')}}</li>
                                        </ul>
                                    </div>
                                @endif
<!-- Token de validação Laravel -->
                                {{csrf_field()}}
                                <div class="form-group"> 
<!-- Parte do nome/Status da ficha -->                
                                    <div>  
                                        <label for="NOME_FICHA" style="margin-left: -8%;" class="col-md-3 control-label">Nome da ficha</label>
                                        <div class="col-md-6">
                                            <input type="text" name="NOME_FICHA" class="form-control" autofocus />
                                        </div>
                                        <label for="Status" class="col-md-1 control-label">Status</label>
                                        <div class="col-md-2">
                                            <select name="STATUS" class="col-md-1 form-control">
                                                <option value="0" selected>Inativo</option> 
                                                <option value="1">Ativo</option>
                                            </select>
                                        </div>
                                    </div>
<!-- Parte dos exercicios/sessões -->
                                    <div class="col-md-7">  
                                        <label for="EXERCICIO_UM" style="margin-left: -3%;" class="col-md-1 control-label">Exercicio</label> 
                                        <select name="EXERCICIO_UM" class="col-md-4 form-control">
                                            @foreach ($exercicios->all() as $exercicio)
                                            <option value="{{$exercicio->ID_EXERCICIO}}">{{$exercicio->NOME_EXERCICIO}}</option> 
                                            @endforeach
                                        </select>
                                            <label for="EXERCICIO_UM_QTD_SESSAO" style="margin-left: -3%;" class=" col-md-1 control-label">Sessões</label>
                                            <input name="EXERCICIO_UM_QTD_SESSAO" class="form-control col-md-3"/>
                                    </div>
                                    <div class="col-md-7">  
                                        <label for="EXERCICIO_DOIS" style="margin-left: -3%;" class="col-md-1 control-label">Exercicio</label> 
                                        <select name="EXERCICIO_DOIS" class="col-md-4 form-control">
                                            @foreach ($exercicios->all() as $exercicio)
                                            <option value="{{$exercicio->ID_EXERCICIO}}">{{$exercicio->NOME_EXERCICIO}}</option> 
                                            @endforeach
                                        </select>
                                            <label for="EXERCICIO_DOIS_QTD_SESSAO" style="margin-left: -3%;" class=" col-md-1 control-label">Sessões</label>
                                            <input name="EXERCICIO_DOIS_QTD_SESSAO" class="form-control col-md-3"/>
                                    </div>
                                    <div class="col-md-7">  
                                        <label for="EXERCICIO_TRES" style="margin-left: -3%;" class="col-md-1 control-label">Exercicio</label> 
                                        <select name="EXERCICIO_TRES" class="col-md-4 form-control">
                                            @foreach ($exercicios->all() as $exercicio)
                                            <option value="{{$exercicio->ID_EXERCICIO}}">{{$exercicio->NOME_EXERCICIO}}</option> 
                                            @endforeach
                                        </select>
                                            <label for="EXERCICIO_TRES_QTD_SESSAO" style="margin-left: -3%;" class=" col-md-1 control-label">Sessões</label>
                                            <input name="EXERCICIO_TRES_QTD_SESSAO" class="form-control col-md-3"/>
                                    </div>
                                    <div class="col-md-7">  
                                        <label for="EXERCICIO_QUATRO" style="margin-left: -3%;" class="col-md-1 control-label">Exercicio</label> 
                                        <select name="EXERCICIO_QUATRO" class="col-md-4 form-control">

                                            @foreach ($exercicios->all() as $exercicio)
                                            <option value="{{$exercicio->ID_EXERCICIO}}">{{$exercicio->NOME_EXERCICIO}}</option> 
                                            @endforeach
                                        </select>
                                            <label for="EXERCICIO_QUATRO_QTD_SESSAO" style="margin-left: -3%;" class=" col-md-1 control-label">Sessões</label>
                                            <input name="EXERCICIO_QUATRO_QTD_SESSAO" class="form-control col-md-3"/>
                                            <input type="hidden" name="ID_ALUNO_FICHA" value="{{$aluno->ID}}"/>
                                    </div>
                                </div>

<!-- Botões -->
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">Adicionar aluno</button>
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
