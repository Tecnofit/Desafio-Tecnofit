@extends('dashboard.layout.app')
@section('content-dashboard')


<section>
    <h1>Cadastrar Cliente</h1>
    <div class="card">
        <div class="card-body">

            @include('includes.errors')
            @include('includes.alerts')

            <form method="POST" action="{{ route('customers.store') }}" class="my-3">
                @csrf
                <div class="form-group">
                    <label for="exampleInputName1">Nome</label>
                    <input type="text" class="form-control" id="exampleInputName1" name="name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Senha</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
            </form>
        </div>

    </div>



</section>


@endsection
