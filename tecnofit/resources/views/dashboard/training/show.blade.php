@extends('dashboard.layout.app')
@section('content-dashboard')

    <section>
        <h1>Detalhes do treino</h1>

        <!--Details-->
        <ul class="my-3">
            <li><strong>Cliente:</strong> {{ $training->user->name }}</li>
            <li><strong>Treino:</strong> {{ $training->name }}</li>
            <li><strong>Ativo:</strong> {{ $training->active ? 'Sim' : 'Não'}}</li>
        </ul>
        <!--End Details-->

        <!--Table-->
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Exercicio</th>
                    <th>Sessões</th>
                </tr>
            </thead>
            <tbody>
                @forelse($training->exercises as $exercise)
                    <tr>
                        <td>{{ $exercise->name }}</td>
                        <td>{{ $exercise->sessions }}</td>
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
