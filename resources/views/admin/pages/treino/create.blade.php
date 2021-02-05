@extends('admin.layouts.app')

@section('title', 'Admin User - Github')

@section('content')
<h1 class="text-center">
    Inserir Treino
</h1>
<hr>
<div class="col-8 m-auto">
<div class="text-center mt-3 mb-4">
        <a href="/treino">
            <button class="btn btn-info">Voltar</button>
        </a>
    </div>
   
        <form name="formCad" id="formCad" method="" action=""> 
            <h5 class="card-title">Selecione o Aluno</h5>
            <select class="form-control" name="id_aluno" id="id_aluno">
            @foreach($dados['aluno'] as $dado)
                <?php echo '<option value="'.$dado['id'].'">'.$dado['nome'].'</option>'; ?>
            @endforeach
            </select>
            <hr>
                <div class="card" style="width: 50rem;">
                <div class="card-body">
                    <h5 class="card-title"><b><u>Exercicios</u></b></h5>
                </div>
                    <ul class="list-group list-group-flush">
                    <?php $i = 0; ?>
                    @foreach($dados['exercicio'] as $dado)
                    <?php
                    $i++;
                    echo "  <li class='list-group-item d-flex justify-content-between align-items-center'>
                                <div class='col-sm-8'>
                                    <input name='chklista' id='checkbox".$i."' type='checkbox' value='".$dado['id']."'>
                                    <label for='checkbox".$i."'>".$dado['nome']."</label>
                                </div>
                                <div class='col-sm-4'>
                                <input class='form-control mt-3 mb-4'
                                    type='text' 
                                    name='sessao".$dado['id']."' 
                                    id='sessao".$dado['id']."' 
                                    value='' 
                                    placeholder='Sessões'>
                                    </div>
                            </li>";
                    ?>
                        
                    @endforeach
                        
                        
                    </ul>
                </div>

        <input class="btn btn-primary mt-3 mb-4" 
               type=""
               onclick="EnviarTreino()" 
               value="Enviar">
            
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    function EnviarTreino(){
        
        let dados = [];
        
        if($("input[name='chklista']").is(':checked')){
            $('input[name="chklista"]:checked').toArray().map(function(check) { 
            
                dados.push({
                    id_aluno: $("#id_aluno").val(),
                    id_exercicio: $(check).val(),
                    sessao:  ($("#sessao"+$(check).val()).val() == 0) ? 10 : $("#sessao"+$(check).val()).val(),
                    status: 0
                });
    
            });
    
            let _token   = $('meta[name="csrf-token"]').attr('content');
            
            $.ajax({
                url: "{{ url('api/Treino') }}",
                type: "POST",
                data: {
                        dados,
                        _token: _token
                },
                dataType: "json",
                success:function(resp){
                    Swal.fire(
                        'Cadastrado!',
                        'Treino cadastrado com sucesso.',
                        'success'
                        )
                },
                error:function(xhr, err){
                    console.log(err.toString());
                }
            });
        } else {
            Swal.fire(
                    'Atenção!',
                    'Selecione um Exercicio.',
                    'warning'
                    );
        }
    }

</script>


@endsection