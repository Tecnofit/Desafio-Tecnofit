@extends('dashboard.layout.app')
@section('content-dashboard')
    <section>
        <h1>Treinos</h1>
        @include('includes.alerts')
        <a href="{{ route('trainings.create') }}" class="btn btn-primary my-3 float-right">Cadastrar</a>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Treino</th>
                    <th width="200">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trainings as $training)
                    <tr>
                        <td>{{ $training->id }}</td>
                        <td>{{ $training->name }}</td>
                        <td>
                            @if ($training->active)
                                <span class="badge badge-success">Ativo</span>
                            @else
                                <span class="badge badge-danger">Desativado</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('trainings.show', $training->id) }}" class="mx-1">
                                <i class="fa fa-search text-dark"></i>
                            </a>
                            <a href="{{ route('trainings.edit', $training->id) }}" class="mx-1">
                                <i class="fa fa-pen text-dark"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="200">Nenhum item cadastrado!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
