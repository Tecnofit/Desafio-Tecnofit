@extends('layout')

@section('cabecalho')
  Novo aluno
@endsection

@section('conteudo')
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  
  <form method="post">
    @csrf
    <div class="row">
      <div class="col col-6">
        <label for="name">Nome</label>
        <input type="text" class="form-control" name="name" id="name">
      </div>

      <div class="col col-4">
        <label for="email">e-mail</label>
        <input type="text" class="form-control" name="email" id="email">
      </div>
    </div>

    <div class="row">
      <div class="col col-8 mt-2">
        <label for="address">Endereço</label>
        <input type="text" class="form-control" name="address" id="address">
      </div>

      <div class="col col-2 mt-2">
        <label for="age">Idade</label>
        <input type="number" class="form-control" name="age" id="age">
      </div>
    </div>

    <div class="row">
      <div class="col col-8 mt-2">
        <label for="notes">Observações</label>
        <input type="text" class="form-control" name="notes" id="notes">
      </div>

      <div class="col col-2 mt-2">
        <label for="active_workout">Treino</label>
        <input type="number" class="form-control" name="active_workout" id="active_workout">
      </div>
    </div>
   

    <button class="btn btn-primary mt-2">Salvar</button>
    <a href="{{ route('show_students') }}" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
  </form>
  
@endsection