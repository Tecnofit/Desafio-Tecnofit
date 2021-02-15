@extends('dashboard.layout.app')
@section('content-dashboard')
    <section>
        <h1>Cadastrar Treino</h1>
        <div class="card">
            <div class="card-body">
                @include('includes.errors')
                @include('includes.alerts')
                <form method="POST" action="{{ route('trainings.store') }}" class="my-3">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlSelect1">Selecione o cliente</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="user_id">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Exercicio</th>
                                <th>Sessões</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exercises as $key => $exercise)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                value="{{ $exercise->id }}"
                                                id="{{ 'checkbox' . $key }}"
                                                name="{{ 'exercises[' . $key . '][exercise_id]' }}" />
                                            <label class="form-check-label"
                                                for="{{ 'checkbox' . $key }}">{{ $exercise->name }}</label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type='number' name="{{ 'exercises[' . $key . '][sessions]' }}"
                                            class="form-control">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
                </form>
            </div>
        </div>
    </section>
@endsection
