@extends('admin.layouts.app')

@section('title', 'Admin User - Github')

@section('content')
<h1 class="text-center">
    Atualizar Aluno
</h1>
<hr>
<div class="col-8 m-auto">
<div class="text-center mt-3 mb-4">
        <a href="/users">
            <button class="btn btn-info">Voltar</button>
        </a>
    </div>
   
        <form name="formCad" id="formCad" method="" action="/updateAluno">   
        
        <input class="form-control mt-3 mb-4" 
               type="text" 
               name="nome" 
               id="nome" 
               value="{{$data->nome}}"
               placeholder="Nome">

        <input class="form-control mt-3 mb-4" 
               type="hidden"    
               name="id" 
               id="id" 
               value="{{$data->id}}" 
               placeholder="Id">

        <input class="form-control mt-3 mb-4" 
               type="text" 
               name="email" 
               id="email" 
               value="{{$data->email}}" 
               placeholder="E-mail">        
        
        <input class="btn btn-primary mt-3 mb-4" 
               type="submit"
               onclick="" 
               value="Enviar">
    </form>
</div>

@endsection