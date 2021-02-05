@extends('admin.layouts.app')

@section('title', 'Admin User - Github')

@section('content')

<h1 class="text-center">Vizualizar</h1>
<hr>
<div class="col-8 m-auto">
    <div class="text-center mt-4 mb-5">
        <a href="/aluno">
            <button class="btn btn-info">Voltar</button>
        </a>
    </div>
    <div class="card" style="width: 26rem;">
        <div class="title m-b-md">
            <img src="https://s3-sa-east-1.amazonaws.com/tecnofit-pub/app/01_200px.png">
        </div>
        <div class="card-body">
            <h5 class="card-title text-center">           
                Aluno: <b>{{ $data['aluno']->nome }}</b>
            </h5>
            <p class="card-text">Email: <b>{{$data['aluno']->email}}</b></p>
            <p class="card-text">Cadastrado: <b>{{$data['aluno']->created_at}}</b></p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item text-center">Treino: <b>{{$data['treino'] == 0 ? 'Não Ativo': 'Ativo'}}</b></li>
            @foreach($arrayExercicio as $exercicio)
                <?php
                    if($data['treino'] == 0) {
                        $status = 'Não ativo';
                    } else {
                        switch($exercicio['status']) {
                            case 0: $status = 'Exercitando';
                                break;
                            case 1: $status = 'Finalizado';
                                break;
                            case 2: $status = 'Pulou';
                                break;
                            default: $status = 'Exercitando';
                        }
                    }
                    
                    echo "<li class='list-group-item'>Exercicios: <b>".$exercicio['nome']."</b> <br>Situação: <b>".$status."</b></li>"; 
                ?>
            @endforeach
                     

        </ul>
        <div class="card-body">
            <a href="" class="card-link" target="_blank"></a>           
        </div>
    </div>    
</div>
@endsection