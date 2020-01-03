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
<!-- Script responsável pela formatação do campo CPF -->
        <script>
            $(document).ready(function(){
                $("#CPF").mask("000.000.000-00")
            })
        </script>
    </head>

    <body>
<!-- Painel de cadastro de alunos -->
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
<!-- Titulo do form -->
                        <div class="panel-heading"><h1 style="text-align: center;">Cadastro de aluno</h1></div>
                        <div class="panel-body">
<!-- Inicio do Forms -->
                            <form class="form-horizontal" action="{{url('/aluno/store')}}" role="form" method="POST" >
<!-- Mensagem de erro em casos de falha do cadastro // Aprender a alterar a mensagem-->
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error}}</li>
                                        @endforeach
                                    </div>
                                @endif
<!--Mensagem de sucesso ao cadastra aluno(a) -->
                                @if(Session::has('AlunoAdded'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{{Session::get('AlunoAdded')}}</li>
                                        </ul>
                                    </div>
                                @endif
<!-- Token de validação Laravel -->
                                {{csrf_field()}}
                                <div class="form-group"> 
<!-- Primeira linha -->                  
                                    <label for="name" class="col-md-1 control-label">Nome</label>
                                    <div class="col-md-6">
                                        <input type="text" name="NOME" class="form-control" value="{{ old('NOME') }}"autofocus />
                                    </div>
                                         <label for="cpf" class="col-md-1 control-label">CPF</label>
                                    <div class="col-md-4">
                                        
                                        <input type="text" placeholder="Ex.: 000.000.000-00" name="CPF" class="form-control" id="CPF" />
                                    </div>
                                </div>
<!-- Segunda linha -->
                                <div class="form-group">
                                    <label for="nascimento" style="margin-left: -25px;" class="col-md-3 control-label">Data de nascimento</label>
                                    <div class="col-md-4">
                                       <input type="date" name="DATA_NASCIMENTO" class="form-control"/>
                                    </div>
                                    <label for="sexo" class="col-md-1 control-label">Sexo</label>
                                    <div class="col-md-4">     
                                        <select name="SEXO" class="col-md-1 form-control">
                                            <option value="Outro" selected>Outro</option> 
                                            <option value="Masculino">Masculino</option>
                                            <option value="Feminino">Feminino</option>
                                        </select>
                                    </div>
                                </div>
<!-- Terceira linha -->
                                <div class="form-group">
                                    <label for="obs" class=" col-md-1 control-label">Observação</label>
                                    <div class="col-md-10" style="margin-left: 5%;">
                                        <textarea name="OBS" class="form-control" rows="5" cols="50"></textarea>
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
