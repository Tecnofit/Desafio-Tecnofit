@extends('admin.layouts.app')

@section('title', 'Admin User - Github')

@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<div class="col-8 m-auto">
    @csrf
    <div class="text-center mt-3 mb-4">
        <?php
        if ($dados['status'] == 1) { ?>
            <a href="{{url('treino/create')}}">
                <button class='btn btn-success'>Cadastrar Treino</button>
            </a>
        <?php
        }  else {
            echo " <a href='/home'>
                        <button class='btn btn-success'>Principal</button>
                    </a>";
            echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Atenção! </strong> Para Cadastrar um Treino Precisa ter: [ Aluno | Exercicios ] <strong>Cadastrados</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
        }
        ?>
       
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

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$("#rest").html("");
    let html = "";
    let subhtml = "";    

    $(document).ready(function(){
        $.ajax({
            url: "{{ url('api/Aluno') }}",
            type: "GET",
            dataType: "json",
            success:function(resp){                
                $.each(resp, function(index, value){
                    montarTabela(value);
                });
            },
            error:function(xhr, err){
                console.log(erro.toString());
            }
        });       
    });

    function montarTabela(valueEnv) {
        var surl = "";

        button =  (valueEnv.ativo == 1) ? "<button class='btn btn-danger fa fa-hand-o-down' data-toggle='tooltip' data-placement='top' title='Desativar Treinamento'></button>" :
                                          "<button class='btn btn-success fa fa-hand-o-up' data-toggle='tooltip' data-placement='top' title='Ativar Treinamento'></button>";
        html += "<tr>";
        html += "<td>"+valueEnv.id+"</td>";
        html += "<td>"+valueEnv.nome+"</td>";    
        html += "<td  width='200'>";
        html += "   <a href='#' onclick='AtivarTreino("+valueEnv.id+")'>"+button+"</a><input type='hidden' name='ativo' id='ativo' value='"+valueEnv.ativo+"'>";
        html += "   <a href='#' onclick='esconderLinha("+valueEnv.id+")'> <button class='btn btn-light fa fa-plus' data-toggle='tooltip' data-placement='top' title='Mostrar Exercicios'></button> </a>";
        html += "</td>";
        html += "</tr>";
        html += "<tr id='"+valueEnv.id+"' style='display: none'>";
        html += "   <td></td>";
        html += "   <td colspan='4'>";
        html += "       <table class='table table-bordered'>";
        html += "           <thead><tr>";
        html += "           <th> Exercicio </th>";
        html += "           <th> sessões </th>";
        html += "           <th> situação </th>";
        html += "           <th> Action </th>";
        html += "           </tr></thead>";
        html += "           <tbody id='SubRest"+valueEnv.id+"'>";

       var surl = "http://localhost:8000/api/AlunoExercicio/"+valueEnv.id;

        $.ajax({
            url: surl,
            type: "GET",
            dataType: "Json",
            success:function(resp){
                $("#SubRest"+valueEnv.id).html("");                
                $.each(resp, function(index, value){                    
                    if(valueEnv.ativo == 1) {
                        switch(value.status) {
                            case 0: status = 'Exercitando';
                                break;
                            case 1: status = 'Finalizado';
                                break;
                            case 2: status = 'Pulou';
                                break;
                            default: status = 'Exercitando';
                        }
                    } else {
                        status = 'Não ativo';
                    }
                    
                     
                   subhtml += "<tr>";
                   subhtml += "  <td>"+value.nome+"</td>";
                   subhtml += "  <td>"+value.sessao+"</td>";
                   subhtml += "  <td>"+status+"</td>";
                   subhtml += "<td  width='200'>";                   
                   subhtml += "   <a href='#' onclick='PularTreino("+value.id_exercicio+", "+valueEnv.id+")'> <button class='btn btn-primary fa fa-rocket' data-toggle='tooltip' data-placement='top' title='Pular'></button></a>";
                   subhtml += "   <a href='#' onclick='FinalizarTreino("+value.id_exercicio+","+valueEnv.id+")'> <button class='btn btn-success fa fa-space-shuttle' data-toggle='tooltip' data-placement='top' title='Finalizar'></button></a>";
                   subhtml += "</td>";
                   subhtml += "</tr>";
                });
                $("#SubRest"+valueEnv.id).html(subhtml);
                subhtml = "";
            },
            error:function(xhr, err){
                console.log(erro.toString());
            }
        });
                
        html += "           </tbody>";
        html += "       </table>";
        html += "   </td>";
        html += "</tr>";


        $("#rest").html(html);
        
    }

    function esconderLinha(idDaLinha) {
        $("#" + idDaLinha).toggle();
    }

    function AtivarTreino(id) {
    
        let titulo =  ($("#ativo").val() == 0) ? 'Ativar' : 'Desativar';
        let url = "http://localhost:8000/api/AtivaTreino/"+id;

        Swal.fire({
            title: titulo+'?',
            text: "Você tem certeza que deseja "+titulo+" o Treino!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, '+titulo+'!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success:function(resp){                
                        Swal.fire(
                            'Ativado!',
                            'Treino ativado com sucesso.',
                            'success'
                            )
                        location.reload();
                    },
                    error:function(xhr, err){
                        console.log(erro.toString());
                    }
                });
                
            }
        });
    }

    function PularTreino(id_exercicio, id_aluno) {

        var url = "http://localhost:8000/api/PularExercicio/"+id_aluno;
        Swal.fire({
            title: 'Pular?',
            text: "Você tem certeza que deseja pular o Exercicio!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, Pular!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                         id_exercicio: id_exercicio
                    },
                    dataType: "json",
                    success:function(resp){                
                        Swal.fire(
                            'Pulado!',
                            'Treino pulado com sucesso.',
                            'success'
                            )
                        location.reload();
                    },
                    error:function(xhr, err){
                        console.log(erro.toString());
                    }
                });
                
            }
        });
    }

    function FinalizarTreino(id_exercicio, id_aluno) {

        var url = "http://localhost:8000/api/FinalizarExercicio/"+id_aluno;
        Swal.fire({
            title: 'Finalizar?',
            text: "Você tem certeza que deseja finalizar o Exercicio!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, Finalizar!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                         id_exercicio: id_exercicio
                    },
                    dataType: "json",
                    success:function(resp){                
                        Swal.fire(
                            'Finalizado!',
                            'Treino finalizado com sucesso.',
                            'success'
                            )
                        location.reload();
                    },
                    error:function(xhr, err){
                        console.log(erro.toString());
                    }
                });
            }
        });
        }


    function TreinoUpdate(id){
        var url = "http://localhost:8000/treinoUpdate/"+id;
        $(location).attr('href', url);
    }
    
</script>

@endsection