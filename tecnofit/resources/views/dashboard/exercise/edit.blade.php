@extends('dashboard.layout.app')
@section('content-dashboard')
<section>
    <h1>Editar Exercicio</h1>
    <div class="card">
        <div class="card-body">
            @include('includes.errors')
            @include('includes.alerts')
            <form class="app_form" action="{{ route('exercises.update', $exercise->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputName1">Nome</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="name" value="{{ old('name') ?? $exercise->name }}">
                </div>
                <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
            </form>
        </div>
    </div>
</section>
@endsection
