<script type="text/javascript" src="<?php echo BASE_PROJECT; ?>Views/includes/athlete.js"> </script>

<div class="body-msg">
</div>

<div class="body-line">
	<div class="body-title">
		<h3>Atletas</h3>
		<button id="new-athlete" data-modal="#modal-athlete">Novo Atleta</button>
	</div>
</div>
<div class="body-line">
	<div class="athlete-list">
		<?php include PATH_PROJECT . "Views/admin/athlete/list.php"; ?>
	</div>
</div>

<div class="modal" id="modal-athlete">
	<form method="POST" action="<?php echo BASE_PROJECT; ?>athlete/save" id="form-athlete">
		<div class="modal-title">Novo Atleta</div>
		<div class="modal-body">
			<div class="modal-msg"></div>
			<input type="hidden" name="id">
			<div>Nome <input type="text" name="name"></div>
			<div>Login <input type="text" name="login"></div>
			<div>Senha <input type="password" name="pass" autocomplete="new-password" ></div>
		</div>
		<div class="modal-footer">
			<input type="submit" name="action" value="Salvar">
		</div>
	</form>
</div>


<div class="modal modal-lg" id="modal-training">
	<div class="modal-title">
		<span></span>
	</div>
	<div class="modal-body">
		<div class="modal-msg"></div>
		<input type="hidden" name="id">
			<div class="form-inline" style="margin-bottom: 15px;">
				<select name="training">
					<option>Selecione o Treino</option>
				</select>
				<button class="add-training" style="float: right;">Adicionar Treino <i class="fas fa-plus"></i></button>
			</div>

		<div class="modal-content">
		</div>

	</div>
	<div class="modal-footer">
	</div>
</div>
