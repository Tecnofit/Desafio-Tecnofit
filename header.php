<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Teste Dev - Hugo Almeida</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link rel="stylesheet" href="style.css">
		<script>

			function deletarPessoa(id){
                $.ajax({
					type: 'POST',
					url: 'api.php',
					data: {
                    acao: 'deletar',
						id: id
					},
					success:function(msg){
                    console.log(msg);
                    if(msg == 'ok'){
                        alert('Pessoa foi deletada com sucesso.');
                    }else{
                        alert('Ocorreu algum problema ao tentar deletar o registro.');
                    }
                    window.location.href = 'alunos.php';
                }
				});
			}

			function deletarExercicio(id){
                $.ajax({
                    type: 'POST',
                    url: 'api_exercicio.php',
                    data: {
                        acao: 'deletar',
                        id: id
                    },
                    success:function(msg){
                        console.log(msg);
                        if(msg == 'ok'){
                            alert('Exercício foi deletado com sucesso.');
                        }
                        else if(msg == 'naopode'){
                            alert('Não é possível excluir esse exercício, ele está ativo em um treino!');
                            return false;
                        }
                        else{
                            alert('Ocorreu algum problema ao tentar deletar o registro.');
                        }
                        window.location.href = 'exercicios.php';
                    }
                });
            }

            function deletarTreino(id){
                $.ajax({
                    type: 'POST',
                    url: 'api_treino.php',
                    data: {
                        acao: 'deletar',
                        id: id
                    },
                    success:function(msg){
                        console.log(msg);
                        if(msg == 'ok'){
                            alert('Treino foi deletado com sucesso.');
                        }else{
                            alert('Ocorreu algum problema ao tentar deletar o registro.');
                        }
                        window.location.href = 'treinos.php';
                    }
                });
            }

			function editarCandidato(id){
                window.location.href='cad_aluno.php?acao=alterar&id='+id;
            }

            function editarTreino(id){
                window.location.href='cad_treino.php?acao=alterar&id='+id;
            }

            function editarExercicio(id){
                window.location.href='cad_exercicio.php?acao=alterar&id='+id;
            }

			$(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
		</script>
	</head>