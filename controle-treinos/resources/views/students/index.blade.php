@extends('layout')

@section('cabecalho')
  Alunos
@endsection

@section('conteudo')
  <a href="{{ route('form_create_student') }}" class="btn btn-dark mb-2">Adicionar</a>

  <ul class="list-group">
  
    @foreach($students as $student)
      <li class="list-group-item d-flex justify-content-between align-items-center">
        {{ $student->id }} - {{ $student->name }}
      
        <span class="d-flex">
        <a href="/students/{{ $student->id }}" class="btn btn-info btn-sm mr-1">
          <i class="fas fa-external-link-alt"></i>
        </a>
        <form method="post" action="/students/{{ $student->id }}"
          onsubmit="return confirm('Deseja excluir o aluno {{ addslashes($student->name) }}?')"
        >
          @csrf
          @method('DELETE')
          <button class="btn btn-danger btn-sm">
            <i class="fas fa-trash"></i>
          </button>
        </form>
      </li>
    @endforeach
  
  </ul>
@endsection