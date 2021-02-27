<table class="full-table" id="table-training-exercise">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Sessões</th>
			<th width="15%">Ação</th>
		</tr>
	</thead>
	<tbody>
		<?php if(!empty($data["list"]) && count($data["list"]) > 0) :
			foreach($data["list"] as $exercise):
		?>
				<tr>
					<td><?=$exercise["name"]?></td>
					<td><?=$exercise["session"]?></td>
					<td>
						<button class="edit-exercise" data-modal="#modal-exercise" data-id="<?=$exercise['id']?>" title="Editar Exercício"><i class="far fa-edit"></i></button>
						<button class="remove-exercise" data-id="<?=$exercise['id']?>"><i class="far fa-trash-alt" title="Remover Exercício"></i></button>
					</td>
				</tr>
		<?php
			endforeach;
		endif;
		?>
	</tbody>
</table>