@extends('dashboard.layout.app')
@section('content-dashboard')

    <section>
        <h1>Clientes</h1>

        <!--Includes-->
        @include('includes.alerts')
        <!--End Includes-->

        <!--Create-->
        <a href="{{ route('customers.create') }}" class="btn btn-primary my-3 float-right">Cadastrar</a>
        <!--End Create-->

        <!--Table-->
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th width="200">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $user->id) }}" class="mx-1">
                                <i class="fa fa-pen text-dark"></i>
                            </a>
                            <form action="{{ route('customers.destroy', $user->id) }}" method="POST"
                                class="mx-1 d-inline-block">
                                @method('DELETE')
                                @csrf
                                <button type="submit" style="border:none;"><i class="fa fa-trash-alt text-danger"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="200">Nenhum item cadastrado!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!--End Table-->
    </section>

@endsection
