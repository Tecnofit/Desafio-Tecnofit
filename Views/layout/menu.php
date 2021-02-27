<?php if($_SESSION["user"]["profile"] && $_SESSION["user"]["profile"] == "ADMIN"): ?>
	<div class="topnav">
		<div class="menu-item active"><a href="<?php echo BASE_PROJECT; ?>athlete/list">Atletas</a></div>
		<div class="menu-item"><a href="<?php echo BASE_PROJECT; ?>training/list">Treinos</a></div>
		<div class="menu-item"><a href="<?php echo BASE_PROJECT; ?>exercise/list">Exercícios</a></div>
	</div>
<?php endif; ?>