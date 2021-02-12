@extends('layout.app')
@section('content')


<div class="auth__wrapper">
    <div class="auth__form">
        <h1>Login</h1>

        @include('includes.errors')
        @include('includes.alerts')

        <form method="POST" action="{{ route('login') }}" class="my-3">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
        </form>

        <div class="alert alert-info" role="alert">
            <h6>Instrutor</h6>
            <ul>
                <li>email: instructor@email.com</li>
                <li>senha: password</li>
            </ul>
        </div>

        <div class="alert alert-light" role="alert">
            <h6>Cliente</h6>
            <ul>
                <li>email: customer@email.com</li>
                <li>senha: password</li>
            </ul>
        </div>

    </div>
</div>

@endsection
