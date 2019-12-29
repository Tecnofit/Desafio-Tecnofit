@extends('layout')

@section('cabecalho')
  Adicionar Aluno
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
  <form method="post" autocomplete="off">
    @csrf
    <div class="row">
      <div class="col col-8">
        <label for="name">Nome</label>
        <input type="text" class="form-control" name="name" id="name">
      </div>
      <div class="col col-2">
        <label for="age">Idade</label>
        <input type="number" class="form-control" name="age" id="age">
      </div>
    </div>

    <div class="row mt-2">
      <div class="col col-10">
        <label for="obs">Observações</label>
        <input type="text" class="form-control" name="obs" id="obs">
      </div>
    </div>

    <button class="btn btn-primary mt-3">Adicionar</button>
  </form>
@endsection
