<?php if($_SESSION["user"]["profile"] && $_SESSION["user"]["profile"] == "ADMIN"): ?>
	<div class="topnav">
		<div class="menu-item"><a href="<?php echo BASE_PROJECT; ?>admin/athlete/list">Atletas</a></div>
		<div class="menu-item"><a href="<?php echo BASE_PROJECT; ?>admin/training/list">Treinos</a></div>
		<div class="menu-item"><a href="<?php echo BASE_PROJECT; ?>admin/exercise/list">Exercícios</a></div>

		<div class="menu-item pull-right"><a href="<?php echo BASE_PROJECT; ?>logout">Sair</a></div>
	</div>
<?php elseif($_SESSION["user"]["profile"] && $_SESSION["user"]["profile"] == "ATHLETE"): ?>
	<div class="topnav">
		<div class="menu-item"><a href="<?php echo BASE_PROJECT; ?>athlete/index">Meus Treinos</a></div>

		<?php if(UserServices::getUserTrainingActive(["id_user" => $_SESSION["user"]["id"]])) : ?>
			<div class="menu-item"><a href="<?php echo BASE_PROJECT; ?>athlete/execute-training">Continuar Treino</a></div>
		<?php endif; ?>

		<div class="menu-item pull-right"><a href="<?php echo BASE_PROJECT; ?>logout">Sair</a></div>
	</div>
<?php endif; ?>