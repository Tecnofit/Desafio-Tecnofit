@extends('dashboard.layout.app')
@section('content-dashboard')
<section>
    <h1>Cadastrar Exercicio</h1>
    <div class="card">
        <div class="card-body">
            @include('includes.errors')
            @include('includes.alerts')
            <form method="POST" action="{{ route('exercises.store') }}" class="my-3">
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1">Nome</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="name">
                </div>
                <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
            </form>
        </div>
    </div>
</section>
@endsection
