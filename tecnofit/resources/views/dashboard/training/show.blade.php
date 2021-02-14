@extends('dashboard.layout.app')
@section('content-dashboard')

    <section>
        <h1>Detalhes do treino</h1>

        <!--Details-->
        <ul class="my-3">
            <li><strong>Cliente:</strong> {{ $training->name }}</li>
            <li><strong>Membro desde:</strong> {{ $training->created_at }}</li>
            <li><strong>Treino:</strong>
                @if (isset($training->trainings) && $training->trainings->isNotEmpty())
                    @if ($training->trainings[0]->active)
                        <span class="badge badge-success">Ativo</span>
                    @else
                        <span class="badge badge-warning">Desativado</span>
                    @endif
                @else
                     Nenhum treino foi encontrado
                @endif
            </li>
        </ul>
        <!--End Details-->

        <!--Table-->
        @if (isset($training->trainings) && $training->trainings->isNotEmpty())
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Exercicio</th>
                        <th>Sessões</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($training->trainings as $item)
                        <tr>
                            <td>{{ $item->exercises->name }}</td>
                            <td>{{ $item->sessions }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        <!--End Table-->
    </section>

@endsection
