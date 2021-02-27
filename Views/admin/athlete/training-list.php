<table class="full-table" id="table-training-training">
	<thead>
		<tr>
			<th>Treino</th>
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
					<td><?=($training["active"] == true) ? "Ativo" : "Inativo"?></td>
					<td>
						<button class="remove-training" data-id="<?=$training['id']?>"><i class="far fa-trash-alt" title="Remover Treino"></i></button>
					</td>
				</tr>
		<?php
			endforeach;
		endif;
		?>
	</tbody>
</table>