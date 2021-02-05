@extends('admin.layouts.app')

@section('title', 'Admin User - Github')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div class="col-8 m-auto">
    @csrf
    <div class="text-center mt-3 mb-4">
        <a href="{{url('exercicio/create')}}">
            <button class="btn btn-success">Cadastrar Exercicio</button>
        </a>
    </div>
    
    <table class="table text-center">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>                
                <th>nome</th>               
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="rest">
            
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

    $("#rest").html("");
    let html = "";
    let subhtml = "";    

    $(document).ready(function(){
        $.ajax({
            url: "{{ url('api/Exercicio') }}",
            type: "GET",
            dataType: "json",
            success:function(resp){
                $num  = 7;
                $.each(resp, function(index, value){
                    html += "<tr>";
                    html += "<td>"+value.id+"</td>";
                    html += "<td>"+value.nome+"</td>";                   
                    html += "<td  width='200'>";                   
                    html += "   <a href='#' onclick='ExercicioUpdate("+value.id+")'> <button class='btn btn-primary fa fas fa-edit'></button> </a>";
                    html += "   <a href='#' onclick='DeletarExercicio("+value.id+")'> <button class='btn btn-danger fa fas fa-eraser'></button> </a>";
                    html += "</td>";
                    html += "</tr>";                
                });
                $("#rest").html(html);
            },
            error:function(xhr, err){
                console.log(erro.toString());
            }
        });       
    });

    function DeletarExercicio(id) {

        var url = "http://localhost:8000/api/Exercicio/"+id;
        Swal.fire({
            title: 'Exclusão?',
            text: "Você tem certeza que deseja excluir o Exercicio!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, Deletar!'
            }).then((result) => {
            if (result.isConfirmed) {                
                var urlconsult = "http://localhost:8000/api/verficaExercicio/"+id;
                $.ajax({
                    url: urlconsult,
                    type: "GET",
                    dataType: "json",
                    success:function(resp){
                        if(resp) {
                            $.ajax({
                                url: url,
                                type: "DELETE",
                                dataType: "json",
                                success:function(resp){                
                                    Swal.fire(
                                        'Excluído!',
                                        'Exercicio excluído com sucesso.',
                                        'success'
                                        )
                                    location.reload();
                                },
                                error:function(xhr, err){
                                    console.log(erro.toString());
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erro',
                                text: 'Exercicio não pode ser excluído vinculado a um Treino',
                                footer: '<a href="https://www.tecnofit.com.br/" target="_blank">Tecnofit - Impulsione resultados </a>'
                            });
                        }

                    },
                    error:function(xhr, err){
                        console.log(erro.toString());
                    }
                });
            }
        });
    }


    function ExercicioUpdate(id){
        var url = "http://localhost:8000/exercicioUpdate/"+id;
        $(location).attr('href', url);
    }
    
</script>

@endsection