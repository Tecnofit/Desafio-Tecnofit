@extends('layout')

@section('cabecalho')
  Controle de Treinos
@endsection

@section('conteudo')


<a href="{{ route('show_students') }}" id="cancel" name="cancel" class="btn btn-primary" role="button">Alunos</a>

<a href="{{ route('show_exercices') }}" id="cancel" name="cancel" class="btn btn-primary" role="button">Exercícios</a>
@endsection