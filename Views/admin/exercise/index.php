<script type="text/javascript" src="<?php echo BASE_PROJECT; ?>Views/includes/exercise.js"> </script>

<div class="body-msg">
</div>

<div class="body-line">
	<div class="body-title">
		<h3>Exercícios</h3>
		<button id="new-exercise" data-modal="#modal-exercise">Novo Exercício</button>
	</div>
</div>
<div class="body-line">
	<div class="exercise-list">
		<?php include PATH_PROJECT . "Views/admin/exercise/list.php"; ?>
	</div>
</div>

<div class="modal" id="modal-exercise">
	<form method="POST" action="<?php echo BASE_PROJECT; ?>exercise/save" id="form-exercise">
		<div class="modal-title">Novo Exercício</div>
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


<div class="modal" id="modal-exercise-exercises">
	<form method="POST" action="<?php echo BASE_PROJECT; ?>exercise/save" id="form-exercise">
		<div class="modal-title">Exercícios</div>
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
