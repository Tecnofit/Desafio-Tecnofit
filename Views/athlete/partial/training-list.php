<table class="full-table" id="table-training-training">
	<thead>
		<tr>
			<th>Treino</th>
			<th>Total Exercícios</th>
			<th>Total Sessões</th>
			<th>Status</th>
			<th width="15%">Ação</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($data["list"]) && count($data["list"]) > 0) :
			foreach($data["list"] as $training):
		?>
				<tr>
					<td><?=$training["name"]?></td>
					<td><?=$training["total_exercise"] ?? 0?></td>
					<td><?=$training["total_session"] ?? 0?></td>
					<td><?=($training["active"] == true) ? "Ativo" : "Inativo"?></td>
					<td>
						<?php if($training["active"] == true) : ?>
							<button class="continue-training" data-id="<?=$training['id']?>">Acessar Treino <i class="fas fa-running"></i></button>
						<?php else : ?>
							<button class="play-training" data-id="<?=$training['id']?>">Iniciar Treino <i class="fas fa-play"></i></button>
						<?php endif; ?>
					</td>
				</tr>
		<?php
			endforeach;
		endif;
		?>
	</tbody>
</table>