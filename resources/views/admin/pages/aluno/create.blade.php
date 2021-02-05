@extends('admin.layouts.app')

@section('title', 'Admin User - Github')

@section('content')
<h1 class="text-center">
    Inserir Aluno
</h1>
<hr>
<div class="col-8 m-auto">
<div class="text-center mt-3 mb-4">
        <a href="/aluno">
            <button class="btn btn-info">Voltar</button>
        </a>
    </div>
   
        <form name="formCad" id="formCad" method="" action="">   
        
        <input class="form-control mt-3 mb-4" 
               type="text" 
               name="nome" 
               id="nome" 
               value="" 
               placeholder="Nome">

        <input class="form-control mt-3 mb-4" 
               type="text" 
               name="email" 
               id="email" 
               value="" 
               placeholder="E-mail">
        
        <input class="btn btn-primary mt-3 mb-4" 
               type="text"
               onclick="EnviarAluno()" 
               value="Enviar">
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    function EnviarAluno(){

        if (($("#nome").val() == '')|| 
            ($("#email").val() == '')){
                Swal.fire({
                        icon: 'warning',
                        title: 'Atenção',
                        text: ' Os campos Nome e Email devem ser preenchidos!',
                        footer: '<a href="https://www.tecnofit.com.br/" target="_blank">Tecnofit - Impulsione resultados </a>'
                    });
        } else {
            let nome = $("#nome").val();
            let email = $("#email").val();
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ url('api/Aluno') }}",
                type: "POST",
                data: {
                        nome: nome,
                        email: email,                  
                        _token: _token
                },
                dataType: "json",
                success:function(resp){                
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Exercicio gravado com Sucesso',
                        footer: '<a href="https://www.tecnofit.com.br/" target="_blank">Tecnofit - Impulsione resultados </a>'
                    });
                },
                error:function(xhr, err){
                    console.log(erro.toString());
                }
            });
        }       
        
    }

</script>


@endsection