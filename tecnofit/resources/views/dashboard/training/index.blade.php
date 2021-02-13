@extends('dashboard.layout.app')
@section('content-dashboard')

    <section>
        <h1>Treinos</h1>

        <!--Includes-->
        @include('includes.alerts')
        <!--End Includes-->

        <!--Create-->
        <a href="{{ route('trainings.create') }}" class="btn btn-primary my-3 float-right">Cadastrar</a>
        <!--End Create-->

        <!--Table-->
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Treino</th>
                    <th>Status</th>
                    <th width="200">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($trainings as $training)
                    <tr>
                        <td>{{ $training->id }}</td>
                        <td>{{ $training->user->name }}</td>
                        <td>{{ $training->name }}</td>
                        <td>
                            @if ($training->active)
                                <span class="badge badge-success">Sim</span>
                            @else
                                <span class="badge badge-warning">Não</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('trainings.show', $training->id) }}" class="mx-1">
                                <i class="fa fa-search text-dark"></i>
                            </a>
                            <a href="{{ route('trainings.edit', $training->id) }}" class="mx-1">
                                <i class="fa fa-pen text-dark"></i>
                            </a>
                            <form action="{{ route('trainings.destroy', $training->id) }}" method="POST"
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
