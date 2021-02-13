@extends('dashboard.layout.app')
@section('content-dashboard')

    <section>
        <h1>Atualizar Treino</h1>
        <div class="card">
            <div class="card-body">

                @include('includes.errors')
                @include('includes.alerts')

                <form method="POST" action="{{ route('trainings.update', $training->id) }}" class="my-3">
                    @csrf
                    @method('PUT')

                    <div class="form-row">

                        <input type="hidden" name="user_id" value="{{ $training->user->id }}"/>

                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Cliente</label>
                            <input type="text" class="form-control" id="exampleInputName1" disabled
                                value="{{ $training->user->name }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Treino</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="name"
                                value="{{ old('name') ?? $training->name }}">
                        </div>
                    </div>

                    <table class="table" id="dynamicTable">
                        <thead class="thead-dark">
                            <tr>
                                <th>Exercicio</th>
                                <th>Sessões</th>
                                <th>Acão</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($training->exercises as $key => $exercise)
                                <tr>
                                    <td>
                                        <input type="text" name="{{ 'exercises[' . $key . '][name]' }}"
                                            class="form-control" value="{{ $exercise->name }}" />
                                    </td>
                                    <td>
                                        <input type="number" name="{{ 'exercises[' . $key . '][sessions]' }}"
                                            class="form-control" value="{{ $exercise->sessions }}" />
                                    </td>
                                    <td>
                                        <button type="button" style="border:none;" class="remove-tr"><i
                                                class="fa fa-trash-alt text-danger"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between">
                        <button type="button" name="add" id="add" class="btn btn-dark">
                            <i class="fa fa-plus"></i>
                        </button>

                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
