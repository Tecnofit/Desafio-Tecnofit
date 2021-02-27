<!DOCTYPE html>
<html>
	<head>
		<title>Desafio Tecnofit - Leandro Ivanaga</title>
		<link rel="stylesheet" href="<?php echo BASE_PROJECT; ?>Views/includes/main.css">
		<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

		<link rel="stylesheet" href="<?php echo BASE_PROJECT; ?>Views/includes/fontawesome/css/all.css">
		<script src="<?php echo BASE_PROJECT; ?>Views/includes/jquery.min.js"></script>
		<script type="text/javascript">
			localStorage.setItem("BASE_PROJECT", <?=BASE_PROJECT?>);
		</script>

	</head>
	<body>
		<?php include PATH_PROJECT . "Views/layout/menu.php"; ?>

		<div class="body-content">
			<?php include PATH_PROJECT . "Views/" . $view; ?>
		</div>
	</body>
</html>