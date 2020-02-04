<?php

//**fazer o cadastrar buscar pela url tambem

    session_start();
    $lgUsuario  = $_SESSION["email"];
    if($lgUsuario){
?>
<html>
    <head>
        <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
            <!--<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>-->
            <title>Academia - Exercicio</title> 
    </head>
 
    <body>
        <?php include 'menu.php'?>
    <div class="container">
    
        <form id='mForm'>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Código do Treino</label>
                <div class="col-sm-10">                    
                    <input type="text" class="form-control" id="idCod" name="cod_exercicio" placeholder="Codigo do Exercício">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nome do Exercício</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="idNome" name="nome_exercicio" placeholder="Nome do Exercício">
                </div>
            </div>
            
            <div class="form-group row">
                <div class="mensagem">
                     <span id='mensagem'><span>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" id="btnCadastrar" name='btnCadastro'>Cadastrar</button> 
                    <button type="submit" class="btn btn-warning invisible" id="btnAtualizar" name='btnAtualizar' >Atualizar</button>
                    
                </div>
            </div>
            <div>
                <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id. Exercício</th>
                                <th scope="col">Nome Exercício</th>
                                <th scope="col">Editar /Deletar</th>
                            </tr>
                        </thead>
                    <tbody id='buscaInfos'>
                        <!--recebe as informaçoes retornadas do banco-->
                    </tbody>
                </table>
            </div>
       </form>
     </div>
    </body> 
</html>

<?php
}
else{
   if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
 session_destroy();  
 header("Location: index2.php");
}
?>

<script>
//-----------------buscar dados
$(document).ready(function(){
    $.ajax({
                url: "controle.php?tipo=buscar",
            success: function(result){
                $('#buscaInfos').append(result);
        }
    });
    $.ajax({
                url: "controle.php?tipo=tipoTreino",
            success: function(result){
                //console.log(result);
                 for (i = 0; i <= result.length; i++) {
                     //console.log(i);
                    $('select').append('<option>' + result[i] + '</option>');
                }  
                
            //$('#buscaTreinos')



        }
    });
});



//-----------------cadastro / insere os dados

    $("#btnCadastrar").click(function(){
        $( "form" ).submit( function ( event ) {

             var infos = $( this ).serializeArray() 
            var nomeTreino = $('#idNome').val();
            var codTreino  = $('#idCod').val();
            
            if(nomeTreino && codTreino){
                $.ajax({
                            url: "controle.php?tipo=cadastrar",
                            data: infos,
                        method: "POST",
                        success: function(result){
                                $('#mensagem').html("<div class='alert alert-success' role='alert'>Cadastro realizado com sucesso</div>");
                                $('#mForm input[type = text]').val("");
                                $("#mensagem").fadeOut(3000);
                        }
                });    
                $.ajax({
                        url: "controle.php?tipo=buscar",
                        success: function(result){
                        $('#buscaInfos').html(result);
                    }
                });
            }else{
                    $('#mensagem').html("<div class='alert alert-warning' role='alert'>Atenção , é necessário adicionar um Exercício!</div>");
            }

             event.preventDefault();
         }); 
    });

//-----------------deleta infos
 function deletaInfo(i){
      var registro = i;

    decisao = confirm('Realmente gostaria de excluir o registro ?');
    if(decisao==true)
        {
            $.ajax({
                    url: "controle.php?tipo=deletar&registro="+registro+"",
                method: "POST",
                success: function(result){
                    $('#mensagem').html("<div class='alert alert-success' role='alert'>Registro deletado com sucesso</div>");
                    $("#mensagem").fadeOut(3000)
                }
            });
            $.ajax({
                    url: "controle.php?tipo=buscar",
                    success: function(result){
                        $('#buscaInfos').html(result);
                    }
            });
        }
 }

    //-----carrega as informações nos campos
 function carregaInfo(i){    
         var registros = $("#"+i).attr('name');  
         var infos = registros.split("-");
         
         $('#idCod').val(infos[1]);
         $('#idNome').val(infos[2]);
         $('#btnAtualizar').removeClass('invisible'); 
         $('#idCod').addClass('invisible'); 
 }


//------------------ atualiza as informações
     $("#btnAtualizar").click(function(){
        $( "form" ).submit( function ( event ) {

             var infos = $( this ).serializeArray() 

             $.ajax({
                         url: "controle.php?tipo=editar",
                        data: infos,
                      method: "POST",
                     success: function(result){
                            $('#mensagem').html("<div class='alert alert-success' role='alert'>Registro atualizado com sucesso</div>");
                            $('#mForm input[type = text]').val("");
                            $("#mensagem").fadeOut(3000);
                            $('#idCod').removeClass('invisible'); 

                    }
             });    
              $.ajax({
                    url: "controle.php?tipo=buscar",
                    success: function(result){
                    $('#buscaInfos').html(result);
                }
            });
            $('#btnAtualizar').addClass('invisible'); 
            $('#idEmail').removeClass('invisible'); 
             event.preventDefault();
         }); 
    });




</script>