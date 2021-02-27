<?php if(isset($data["currentExercise"]) && !empty($data["currentExercise"])) : ?>
	<div class="body-line">
		<div class="body-title">
			<h3>Treino: <?=$data["training"]["name"];?> - Execício Atual: <?=$data["currentExercise"]["name"]; ?></h3>
		</div>
	</div>
	<div class="body-line">
		<div>Total Sessões: <?=$data["currentExercise"]["session"]; ?></div>
		<div>Sessão Atual: <?=$data["currentExercise"]["executed_session"] ?? 0; ?></div>

		<div style="margin-top: 10px;">
			<button id="finish-session" data-user="<?=$data["training"]["id_user"];?>" data-training="<?=$data["training"]["id_training"];?>" data-exercise="<?=$data["currentExercise"]["id_exercise"];?>">
				Concluir Sessão <i class="fas fa-check"></i>
			</button>
			<button id="finish-exercise" data-user="<?=$data["training"]["id_user"];?>" data-training="<?=$data["training"]["id_training"];?>" data-exercise="<?=$data["currentExercise"]["id_exercise"];?>">
				Finalizar Exercício <i class="fas fa-check-double"></i>
			</button>
			<button id="skip-exercise" data-user="<?=$data["training"]["id_user"];?>" data-training="<?=$data["training"]["id_training"];?>" data-exercise="<?=$data["currentExercise"]["id_exercise"];?>">
				Pular Exercício <i class="fas fa-forward"></i>
			</button>
		</div>
	</div>

<?php endif; ?>

<div class="body-line">
	<div class="body-title">
		<h3>Treino: <?=$data["training"]["name"];?> - Execícios</h3>
	</div>
</div>
<div class="body-line">
	<div class="exercise-list">
		<table class="full-table" id="table-exercise">
			<thead>
				<tr>
					<th>Exercício</th>
					<th>Total Sessões</th>
					<th>Sessões Finalizadas</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($data["list"]) && count($data["list"]) > 0) :
					foreach($data["list"] as $exercise):
				?>
						<tr>
							<td><?=$exercise["name"]?></td>
							<td><?=$exercise["session"] ?? 0?></td>
							<td><?=$exercise["executed_session"] ?? 0?></td>
							<td>
								<?php switch ($exercise["status"]):
									case "COMPLETED";
										echo "Completado";
										break;
									case "SKIPPED";
										echo "Pulado";
											break;
									case "INPROGRESS";
										echo "Em Progresso";
											break;
									default:
										echo "Não iniciado";
								endswitch; ?>
							</td>
						</tr>
				<?php
					endforeach;
				endif;
				?>
			</tbody>
		</table>
	</div>
</div>

