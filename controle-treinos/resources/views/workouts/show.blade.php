@extends('layout')

@section('cabecalho')
  Editar treino
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
    @method('PUT')
    @csrf
    <div class="row">
      <div class="col col-2">
        <label for="name">ID</label>
        <input type="text" class="form-control" name="student_id" id="student_id" value="{{ $student->id }}" readonly>
      </div>
      <div class="col col-6">
        <label for="name">Aluno</label>
        <input type="text" class="form-control" name="student_name" id="student_name" value="{{ $student->name }}" disabled>
      </div>
      <div class="col col-6">
        <label for="name">Nome</label>
        <input type="text" class="form-control" name="name" id="name" value="{{ $workout->name }}">
      </div>
    </div>

    <div class="row">
      <div class="col col-6">
        <label for="description">Descrição</label>
        <input type="text" class="form-control" name="description" id="description">
      </div>
    </div>
        

    <ul id="exercices" name="exercices">
      <label for="id_exercice">Selecione os exercícios:</label>
      @foreach($exercices_options as $exercice)
          <div class="row">
            <div class="col col-6">
              <li name="exercice">
                <input type="checkbox" id="{{ $exercice->id }}" name="exercices_select[{{ $exercice->id }}]" value="{{ $exercice->id }}"
                  <?php echo (in_array($exercice->id, $exercices_active_ids)==true ? 'checked' : '');?>>
                <label for="{{ $exercice->id }}">{{ $exercice->name }}</label>      
              </li>
            </div>
            <div class="col col-4">
              <label for="series[{{ $exercice->id }}]">Seções</label>
              <input type="number" class="form-control" name="series[{{ $exercice->id }}]" id="series[{{ $exercice->id }}]"> 
            </div>
          </div>
      @endforeach
    </ul>
    

    <button class="btn btn-primary mt-2">Salvar</button>
    <a href="/students/{{ $student->id }}" id="cancel" name="cancel" class="btn btn-default">Cancelar</a>
  </form>
  
@endsection