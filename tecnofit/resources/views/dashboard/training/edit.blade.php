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
                        <input type="hidden" name="user_id" value="{{ $training->id }}" />
                        <div class="form-group col-md-6">
                            <label for="exampleInputName1">Cliente</label>
                            <input type="text" class="form-control" id="exampleInputName1" disabled
                                value="{{ $training->name }}">
                        </div>
                    </div>
                    <?php
                    foreach ($training->trainings as $t) {
                        $selectedNames[] = $t->exercises->name;
                        $default[] = array('id' => $t->exercise_id, 'name' => $t->exercises->name, 'sessions' => $t->sessions, 'checked' => true);
                    }
                    foreach($exercises as $e)
                    {
                        if(!in_array($e->name, $selectedNames))
                        {
                            $default[] = array('id' => $e->id, 'name' => $e->name, 'checked' => false, 'sessions' => '');
                        }
                    }
                    ?>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr><th>Exercicio</th><th>Sessões</th></tr>
                        </thead>
                        <tbody>
                            @foreach ($default as $key => $item)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                value="{{ $item['id'] }}"
                                                id="{{ 'checkbox' . $key }}"
                                                name="{{ 'exercises[' . $key . '][exercise_id]' }}"
                                                {{$item['checked'] == true ? 'checked' : ''}}
                                                />
                                            <label class="form-check-label" for="{{ 'checkbox' . $key }}">{{ $item['name'] }}</label>
                                        </div>
                                    </td>
                                    <td>
                                        <input type='number'
                                            name="{{ 'exercises[' . $key . '][sessions]' }}"
                                            class="form-control"
                                            value="{{$item['sessions']}}"
                                        />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
