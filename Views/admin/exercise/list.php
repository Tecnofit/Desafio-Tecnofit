<table class="full-table">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Total Treinos Vinculados</th>
			<th width="15%">Ação</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data["list"] as $exercise): ?>
			<tr>
				<td><?=$exercise["name"]?></td>
				<td><?=$exercise["total_training"]?></td>
				<td>
					<button class="edit-exercise" data-modal="#modal-exercise" data-id="<?=$exercise['id']?>" title="Editar Exercício"><i class="far fa-edit"></i></button>
					<button class="remove-exercise" data-id="<?=$exercise['id']?>"><i class="far fa-trash-alt" title="Remover Exercício"></i></button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>