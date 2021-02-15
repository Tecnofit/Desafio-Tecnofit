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
                @if($training->active !== null)
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
                            <form action="{{ route('trainings.handleActive') }}" method="POST"
                            class="mx-1 d-inline-block">
                            @csrf
                            <input type="hidden" value="{{ $training->id }}" name="user_id" />
                            <input type="hidden" value="{{ $training->active }}" name="active" />
                            <button type="submit" style="border:none; background: transparent;" data-toggle="tooltip" data-placement="top" title="Ativar/Desativar">
                                @if ($training->active)
                                <i class="fa fa-chevron-down text-danger"></i>
                                @else
                                <i class="fa fa-chevron-up text-success"></i>
                                @endif
                            </button>
                        </form>
                        </td>
                    </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="200">Nenhum item cadastrado!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
@endsection
