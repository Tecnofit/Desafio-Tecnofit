@extends('layout')

@section('cabecalho')
  Novo treino
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
  
  protected $fillable = ['name', 'description', 'student_id', 'active', 'done'];

  <form method="post">
    @csrf
    <div class="row">
      <div class="col col-6">
        <label for="name">Nome</label>
        <input type="text" class="form-control" name="name" id="name">
      </div>

      <div class="col col-6">
        <label for="description">Nome</label>
        <input type="text" class="form-control" name="description" id="description">
      </div>

    </div>

    <button class="btn btn-primary mt-2">Salvar</button>
    <a href="{{ route('show_exercices') }}" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
  </form>
  
@endsection