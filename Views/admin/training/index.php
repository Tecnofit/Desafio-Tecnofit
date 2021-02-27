<script type="text/javascript" src="<?php echo BASE_PROJECT; ?>Views/includes/training.js"> </script>

<div class="body-msg">
</div>

<div class="body-line">
	<div class="body-title">
		<h3>Treinos</h3>
		<button id="new-training" data-modal="#modal-training">Novo Treino</button>
	</div>
</div>
<div class="body-line">
	<div class="training-list">
		<?php include PATH_PROJECT . "Views/admin/training/list.php"; ?>
	</div>
</div>

<div class="modal" id="modal-training">
	<form method="POST" action="<?php echo BASE_PROJECT; ?>training/save" id="form-training">
		<div class="modal-title">Novo Treino</div>
		<div class="modal-body">
			<div class="modal-msg"></div>
			<input type="hidden" name="id">
			<div>Nome <input type="text" name="name"></div>
		</div>
		<div class="modal-footer">
			<input type="submit" name="action" value="Salvar">
		</div>
	</form>
</div>


<div class="modal modal-lg" id="modal-training-exercises">
	<div class="modal-title">
		<span></span>
	</div>
	<div class="modal-body">
		<div class="modal-msg"></div>
		<input type="hidden" name="id">
			<div class="form-inline" style="margin-bottom: 15px;">
				<select name="exercise">
					<option>Selecione o Exercício</option>
				</select>
				<label>Qtd Sessões</label> <input type="text" name="session" style="width: 30px;">
				<button class="add-exercise" style="float: right;">Adicionar Exercício <i class="fas fa-plus"></i></button>
			</div>

		<div class="modal-content">
		</div>

	</div>
	<div class="modal-footer">
	</div>
</div>
