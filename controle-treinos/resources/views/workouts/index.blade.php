@extends('layout')

@section('cabecalho')
  Exercícios
@endsection

@section('conteudo')
<a href="{{ route('form_create_exercice') }}" class="btn btn-dark mb-2">Adicionar</a>

  <ul class="list-group">
  
    @foreach($exercices as $exercice)
      <li class="list-group-item d-flex justify-content-between align-items-center">
      {{ $exercice->id }} - {{ $exercice->name }}
      
        <span class="d-flex">
        <a href="/exercices/{{ $exercice->id }}" class="btn btn-info btn-sm mr-1">
          <i class="fas fa-external-link-alt"></i>
        </a>
        <form method="post" action="/exercices/{{ $exercice->id }}"
          onsubmit="return confirm('Deseja excluir o exercício {{ addslashes($exercice->name) }}?')"
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