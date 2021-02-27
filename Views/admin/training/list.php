<table class="full-table">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Total Exercícios</th>
			<th>Total Sessões</th>
			<th width="15%">Ação</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data["list"] as $training): ?>
			<tr>
				<td><?=$training["name"]?></td>
				<td><?=$training["total_exercise"]?></td>
				<td><?=$training["total_session"] ?? 0 ?></td>
				<td>
					<button class="link-exercise" data-modal="#modal-training-exercise" data-id="<?=$training['id']?>" title="Vincular Treino"><i class="fas fa-tasks"></i></button>
					<button class="edit-training" data-modal="#modal-training" data-id="<?=$training['id']?>" title="Editar Treino"><i class="far fa-edit"></i></button>
					<button class="remove-training" data-id="<?=$training['id']?>"><i class="far fa-trash-alt" title="Remover Treino"></i></button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>