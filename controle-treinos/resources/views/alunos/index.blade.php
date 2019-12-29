@extends('layout')

@section('cabecalho')
  Alunos
@endsection

@section('conteudo')
  <a href="{{ route('form_create_aluno') }}" class="btn btn-dark mb-2">Adicionar</a>
@endsection