<table class="full-table">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Login</th>
			<th>Treino Ativo</th>
			<th width="15%">Ação</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data["list"] as $athlete): ?>
			<tr>
				<td><?=$athlete["name"]?></td>
				<td><?=$athlete["login"]?></td>
				<td><?=$athlete["current"]?></td>
				<td>
					<button class="link-training" data-modal="#modal-training" data-id="<?=$athlete['id']?>" title="Vincular Treino"><i class="fas fa-tasks"></i></button>
					<button class="edit-athlete" data-modal="#modal-athlete" data-id="<?=$athlete['id']?>"><i class="fas fa-user-edit"></i></button>
					<button class="remove-athlete" data-id="<?=$athlete['id']?>"><i class="fas fa-user-times"></i></button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>