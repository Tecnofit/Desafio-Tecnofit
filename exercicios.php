<?php include('header.php') ?>
	<body>
		<div class="container">
			<div class="row">
				<div class="panel panel-default users-content">
					<div class="panel-heading row" style="width: auto">
                        <div class="col-lg-4">
                            <h2 style="margin-top: 10px">Lista de Exercícios</h2>
                        </div>
                        <div class="col-lg-8">
                            <button style="margin-top: 6px" type="button" class="new-btn" onclick="location.href='cad_exercicio.php?acao=incluir'">Novo</button>
                            <button style="margin-top: 6px; float: right" type="button" class="home-btn" onclick="location.href='index.php'">Voltar para a Home</button>
                        </div>
                    </div>

					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Nome</th>
								<th>Op&ccedil;&otilde;es</th>
							</tr>
						</thead>
						<tbody id="pessoaData">
							<?php
								include 'DB.php';
								$db = new DB();
								$exercicios = $db->getRows('exercicios',array('order_by'=>'id'));
								if(!empty($exercicios)): $count = 0; foreach($exercicios as $exercicio): $count++;
							?>
							<tr>
								<td><?= $exercicio['id']; ?></td>
								<td><?= $exercicio['nome']; ?></td>
								<td>
									<a href="javascript:void(0);" data-toggle="tooltip" title="Editar" class="glyphicon glyphicon-edit" onclick="editarExercicio('<?=$exercicio['id']; ?>')"></a>
									<a href="javascript:void(0);" data-toggle="tooltip" title="Excluir" class="glyphicon glyphicon-trash" onclick="return confirm('Tem certeza que deseja deletar o exercício?')?deletarExercicio('<?=$exercicio['id'];?>'):false;"></a>
								</td>
							</tr>
							<?php endforeach; else: ?>
							<tr><td colspan="5">Nenhum registro encontrado.</td></tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>