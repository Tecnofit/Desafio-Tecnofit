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
                                @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Treino</label>
                            <input type="text" class="form-control" id="exampleInputName1" name="name">
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
                            <tr>
                                <td>
                                    <input type="text" name="exercises[0][name]" class="form-control" />
                                </td>
                                <td>
                                    <input type="number" name="exercises[0][sessions]" class="form-control" />
                                </td>
                                <td>
                                    <button type="button" name="add" id="add" class="btn btn-dark"><i class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary float-right">Cadastrar</button>
                </form>
            </div>

        </div>



    </section>


@endsection
